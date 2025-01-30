<?php

use App\Http\Controllers\Web\Frontend\ClientDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for Client Dashboard
Route::get('/client-dashboard', [ClientDashboardController::class, 'index'])->name('client-dashboard');
Route::post('/client-dashboard/review', [ClientDashboardController::class, 'storeReview'])->name('client-dashboard.review');
Route::post('/client-dashboard/report', [ClientDashboardController::class, 'storeReport'])->name('client-dashboard.report');
