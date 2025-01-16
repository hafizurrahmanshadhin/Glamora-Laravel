<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
