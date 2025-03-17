<?php

namespace App\Console\Commands;

use App\Models\BusinessInformation;
use App\Models\TravelRadius;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Console\Command;
use Log;

class ReactivateBannedUsers extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ban:reactivate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reactivates users whose ban duration has expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        Log::info('test');
        $users = User::whereNotNull('banned_until')
            ->where('banned_until', '<=', now())
            ->get();

        foreach ($users as $user) {
            $user->banned_until = null;
            $user->save();

            BusinessInformation::where('user_id', $user->id)->update(['status' => 'active']);
            TravelRadius::where('user_id', $user->id)->update(['status' => 'active']);
            UserService::where('user_id', $user->id)->update(['status' => 'active']);

            $this->info("Reactivated user ID: {$user->id}");
        }

        return 0;
    }
}
