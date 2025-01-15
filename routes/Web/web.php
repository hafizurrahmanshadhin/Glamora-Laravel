<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

//! Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});
