<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\StripeController;
use App\Http\Controllers\Web\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('index');

//! Route for User Dashboard
Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('user-dashboard');

//$ Route for Stripe Payment
Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout')->middleware('auth');
    Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
});
