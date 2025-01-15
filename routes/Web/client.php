<?php

use App\Http\Controllers\Web\Frontend\ClientDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Client Dashboard
Route::get('/client-dashboard', [ClientDashboardController::class, 'index'])->name('client-dashboard');
