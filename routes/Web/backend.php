<?php

use App\Http\Controllers\Web\Backend\ClientsFeedbackController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\FAQController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for FAQ Page
Route::controller(FAQController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq.index');
    Route::get('/faq/create', 'create')->name('faq.create');
    Route::post('/faq/store', 'store')->name('faq.store');
    Route::get('/faq/edit/{id}', 'edit')->name('faq.edit');
    Route::put('/faq/update/{id}', 'update')->name('faq.update');
    Route::get('/faq/status/{id}', 'status')->name('faq.status');
    Route::delete('/faq/destroy/{id}', 'destroy')->name('faq.destroy');
});

//! Route for ClientsFeedback Backend
Route::controller(ClientsFeedbackController::class)->group(function () {
    Route::get('/clients-feedback', 'index')->name('clients-feedback.index');
    Route::get('/clients-feedback/create', 'create')->name('clients-feedback.create');
    Route::post('/clients-feedback/store', 'store')->name('clients-feedback.store');
    Route::get('/clients-feedback/edit/{id}', 'edit')->name('clients-feedback.edit');
    Route::put('/clients-feedback/update/{id}', 'update')->name('clients-feedback.update');
    Route::get('/clients-feedback/status/{id}', 'status')->name('clients-feedback.status');
    Route::delete('/clients-feedback/destroy/{id}', 'destroy')->name('clients-feedback.destroy');
});
