<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AllowBeautyExpertMiddleware;
use App\Http\Middleware\BeautyExpertMiddleware;
use App\Http\Middleware\ClientMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Http\Middleware\Authenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/Web/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::middleware(['web'])
                ->group(base_path('routes/Web/auth.php'));

            Route::middleware(['web', 'auth', 'admin'])
                ->prefix('admin')
                ->group(base_path('routes/Web/backend.php'));

            Route::middleware(['web', 'auth', 'admin'])
                ->prefix('admin/settings')
                ->group(base_path('routes/Web/settings.php'));

            Route::middleware(['web', 'auth', 'verified', 'client'])
                ->prefix('client')
                ->group(base_path('routes/Web/client.php'));

            Route::middleware(['web', 'auth', 'verified', 'beauty_expert'])
                ->prefix('beauty-expert')
                ->group(base_path('routes/Web/beauty-expert.php'));
        },
    )
    
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'               => AdminMiddleware::class,
            'client'              => ClientMiddleware::class,
            'beauty_expert'       => BeautyExpertMiddleware::class,
            'allow_beauty_expert' => AllowBeautyExpertMiddleware::class,
            'auth.jwt'            => Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
