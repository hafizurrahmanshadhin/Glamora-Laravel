<?php

use App\Http\Controllers\Web\Frontend\BeautyExpertDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Beauty Expert Dashboard
Route::get('/beauty-expert-dashboard', [BeautyExpertDashboardController::class, 'index'])->name('beauty-expert-dashboard');
Route::post('/toggle-availability', [BeautyExpertDashboardController::class, 'toggleAvailability'])->name('toggle-availability');
