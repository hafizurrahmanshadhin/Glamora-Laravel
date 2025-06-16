<?php

use App\Console\Commands\MakeService;
use Illuminate\Support\Facades\Artisan;

//# registering make service class command
Artisan::command('make:service {name}', function ($name) {
    $this->call(MakeService::class, ['name' => $name]);
});
