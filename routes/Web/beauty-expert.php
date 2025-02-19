<?php

use App\Http\Controllers\Web\Frontend\BeautyExpertDashboardController;
use App\Http\Controllers\Web\Frontend\ServiceProviderProfileController;
use Illuminate\Support\Facades\Route;

//! Route for Beauty Expert Dashboard
Route::controller(BeautyExpertDashboardController::class)->group(function () {
    Route::get('/beauty-expert-dashboard', 'index')->name('beauty-expert-dashboard');
    Route::post('/toggle-availability', 'toggleAvailability')->name('toggle-availability');
});

Route::controller(ServiceProviderProfileController::class)->group(function () {
    Route::get('/edit-profile', 'editProfile')->name('edit-profile');
    Route::post('/tools', 'store')->name('tools.store');
    Route::delete('/tools/{tool}', 'destroy')->name('tools.destroy');
    Route::post('/gallery', 'storeGallery')->name('gallery.store');
    Route::delete('/gallery/{gallery}', 'destroyGallery')->name('gallery.destroy');

    Route::get('/edit-service-information/{user}', 'editServiceInformation')->name('edit-service-information');
    Route::put('/update-service-information/{user}', 'updateServiceInformation')->name('update-service-information');
});
