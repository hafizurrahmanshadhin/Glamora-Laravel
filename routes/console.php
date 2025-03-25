<?php

use App\Console\Commands\MakeService;
use App\Console\Commands\ProcessQueue;
use App\Console\Commands\ReactivateBannedUsers;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

//# registering make service class command
Artisan::command('make:service {name}', function ($name) {
    $this->call(MakeService::class, ['name' => $name]);
});

Schedule::command(ReactivateBannedUsers::class)->everyMinute();
Schedule::command(ProcessQueue::class)->everyMinute();
