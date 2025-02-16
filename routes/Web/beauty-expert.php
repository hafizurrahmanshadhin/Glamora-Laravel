<?php

use App\Http\Controllers\Web\Frontend\BeautyExpertDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Beauty Expert Dashboard
Route::controller(BeautyExpertDashboardController::class)->group(function () {
    Route::get('/beauty-expert-dashboard', 'index')->name('beauty-expert-dashboard');
    Route::post('/toggle-availability', 'toggleAvailability')->name('toggle-availability');
});
