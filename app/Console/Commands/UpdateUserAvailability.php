<?php

namespace App\Console\Commands;

use App\Models\BusinessInformation;
use App\Models\TravelRadius;
use App\Models\User;
use App\Models\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateUserAvailability extends Command {
    protected $signature   = 'users:update-availability';
    protected $description = 'Sync user availability based on unavailable_ranges';

    public function handle() {
        $now         = Carbon::now();
        $currentDate = $now->format('Y-m-d');

        // Get all users who have unavailable_ranges set
        $usersWithRanges = User::whereNotNull('unavailable_ranges')
            ->where('unavailable_ranges', '!=', '[]')
            ->get();

        foreach ($usersWithRanges as $user) {
            $shouldBeUnavailable = false;

            // Check if current date falls within any of the user's unavailable ranges
            foreach ($user->unavailable_ranges as $range) {
                if (isset($range['from_date']) && isset($range['to_date'])) {
                    $fromDate = Carbon::createFromFormat('d/m/Y', $range['from_date'])->format('Y-m-d');
                    $toDate   = Carbon::createFromFormat('d/m/Y', $range['to_date'])->format('Y-m-d');

                    if ($currentDate >= $fromDate && $currentDate <= $toDate) {
                        $shouldBeUnavailable = true;
                        break;
                    }
                }
            }

            $newAvailability = $shouldBeUnavailable ? 'unavailable' : 'available';
            $relatedStatus   = $shouldBeUnavailable ? 'inactive' : 'active';

            // Only update if availability has changed
            if ($user->availability !== $newAvailability) {
                $user->update(['availability' => $newAvailability]);

                // Update related models
                BusinessInformation::where('user_id', $user->id)->update(['status' => $relatedStatus]);
                TravelRadius::where('user_id', $user->id)->update(['status' => $relatedStatus]);
                UserService::where('user_id', $user->id)->update(['status' => $relatedStatus]);

                $this->info("Updated user {$user->id} availability to: {$newAvailability}");
            }
        }

        // Handle users who don't have any ranges but might still be marked unavailable
        User::where(function ($query) {
            $query->whereNull('unavailable_ranges')
                ->orWhere('unavailable_ranges', '[]');
        })
            ->where('availability', 'unavailable')
            ->update(['availability' => 'available']);

        $this->info('User availability sync completed at ' . $now->toDateTimeString());
    }
}
