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
    protected $description = 'Sync user availability based on unavailable_from/unavailable_to windows';

    public function handle() {
        $now = Carbon::now();

        //
        // 1) Mark users as unavailable if now is within their window
        //
        $unavailableUsers = User::whereNotNull('unavailable_from')
            ->whereNotNull('unavailable_to')
            ->where('unavailable_from', '<=', $now)
            ->where('unavailable_to', '>=', $now)
            ->get(['id']);

        if ($unavailableUsers->isNotEmpty()) {
            $ids = $unavailableUsers->pluck('id')->all();

            // Flip their availability
            User::whereIn('id', $ids)
                ->update(['availability' => 'unavailable']);

            // Related tables → inactive
            BusinessInformation::whereIn('user_id', $ids)->update(['status' => 'inactive']);
            TravelRadius::whereIn('user_id', $ids)->update(['status' => 'inactive']);
            UserService::whereIn('user_id', $ids)->update(['status' => 'inactive']);
        }

        //
        // 2) Mark users available once their window has passed
        //
        $expiredUsers = User::whereNotNull('unavailable_to')
            ->where('unavailable_to', '<', $now)
            ->get(['id']);

        if ($expiredUsers->isNotEmpty()) {
            $ids = $expiredUsers->pluck('id')->all();

            User::whereIn('id', $ids)
                ->update([
                    'availability'     => 'available',
                    'unavailable_from' => null,
                    'unavailable_to'   => null,
                ]);

            // Related tables → active
            BusinessInformation::whereIn('user_id', $ids)->update(['status' => 'active']);
            TravelRadius::whereIn('user_id', $ids)->update(['status' => 'active']);
            UserService::whereIn('user_id', $ids)->update(['status' => 'active']);
        }

        $this->info('User availability and related statuses synced at ' . $now->toDateTimeString());
    }
}
