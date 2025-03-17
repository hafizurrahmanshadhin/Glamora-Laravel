<?php

use App\Http\Controllers\Web\Frontend\ClientDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Client Dashboard
Route::controller(ClientDashboardController::class)->group(function () {
    Route::get('/client-dashboard', 'index')->name('client-dashboard');
    Route::post('/client-dashboard/review', 'storeReview')->name('client-dashboard.review');
    Route::post('/client-dashboard/report', 'storeReport')->name('client-dashboard.report');
    Route::delete('/client-dashboard/cancel-booking', 'cancelBooking')->name('client-dashboard.cancel-booking');
});
