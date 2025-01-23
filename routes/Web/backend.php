<?php

use App\Http\Controllers\Web\Backend\AvailableServicesController;
use App\Http\Controllers\Web\Backend\ContactController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\FAQController;
use App\Http\Controllers\Web\Backend\ServiceController;
use App\Http\Controllers\Web\Backend\UserController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for Users Page
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/show/{id}', 'show')->name('user.show');
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

//! Route for Available Beauty Services Page
Route::controller(AvailableServicesController::class)->group(function () {
    Route::get('/available-services', 'index')->name('available.services.index');
    Route::post('/available-services/status/{id}', 'status')->name('available.services.status');
});

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

//! Route for Contacts Page
Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('contacts.index');
    Route::get('/contacts/status/{id}', 'status')->name('contacts.status');
    Route::delete('/contacts/destroy/{id}', 'destroy')->name('contacts.destroy');
});
