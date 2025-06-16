<?php

namespace App\Services\Web\Frontend;

use App\Models\BusinessInformation;
use App\Models\TravelRadius;
use App\Models\User;
use App\Models\UserService;
use Carbon\Carbon;

class UserAvailabilityService {
    public static function run(): void {
        $today = Carbon::today()->toDateString();

        // 1) All users who _have_ ranges
        User::whereNotNull('unavailable_ranges')
            ->where('unavailable_ranges', '!=', '[]')
            ->get()
            ->each(function (User $user) use ($today) {
                $inRange = collect($user->unavailable_ranges)->contains(function ($r) use ($today) {
                    if (isset($r['from_date'], $r['to_date'])) {
                        $from = Carbon::createFromFormat('d/m/Y', $r['from_date'])->toDateString();
                        $to   = Carbon::createFromFormat('d/m/Y', $r['to_date'])->toDateString();
                        return $today >= $from && $today <= $to;
                    }
                    return false;
                });

                $newAvail = $inRange ? 'unavailable' : 'available';
                $newStat  = $inRange ? 'inactive' : 'active';

                if ($user->availability !== $newAvail) {
                    $user->update(['availability' => $newAvail]);
                    BusinessInformation::where('user_id', $user->id)->update(['status' => $newStat]);
                    TravelRadius::where('user_id', $user->id)->update(['status' => $newStat]);
                    UserService::where('user_id', $user->id)->update(['status' => $newStat]);
                }
            });

        // 2) Any user who _doesn’t_ have ranges but is still marked “unavailable”
        User::where(function ($q) {
            $q->whereNull('unavailable_ranges')
                ->orWhere('unavailable_ranges', '[]');
        })
            ->where('availability', 'unavailable')
            ->update(['availability' => 'available']);
    }
}
