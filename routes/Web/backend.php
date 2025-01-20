<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\ServiceController;
use App\Http\Controllers\Web\Backend\UserController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for Users Page
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::post('/user/status/{id}', 'status')->name('user.status');
});

//! Route for Service Backend
Route::controller(ServiceController::class)->group(function () {
    Route::get('/service', 'index')->name('service.index');
    Route::get('/service/create', 'create')->name('service.create');
    Route::post('/service/store', 'store')->name('service.store');
    Route::get('/service/edit/{id}', 'edit')->name('service.edit');
    Route::put('/service/update/{id}', 'update')->name('service.update');
    Route::get('/service/status/{id}', 'status')->name('service.status');
    Route::delete('/service/destroy/{id}', 'destroy')->name('service.destroy');
});
