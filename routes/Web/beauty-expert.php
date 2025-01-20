<?php

use App\Http\Controllers\Web\Frontend\BeautyExpertDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/profile-submitted', function () {
    return view('auth.layouts.profile-submitted');
})->name('profile-submitted');

//! Route for Beauty Expert Dashboard
Route::get('/beauty-expert-dashboard', [BeautyExpertDashboardController::class, 'index'])->name('beauty-expert-dashboard');
