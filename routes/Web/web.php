<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\AvailableServicesController;
use App\Http\Controllers\Web\Frontend\BookServiceController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\DynamicPageController;
use App\Http\Controllers\Web\Frontend\FAQController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\ServiceCategoryController;
use App\Http\Controllers\Web\Frontend\ServiceProviderProfileController;
use App\Models\Content;
use Illuminate\Support\Facades\Route;

//! Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');

//! Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/available-services/{serviceId}', [AvailableServicesController::class, 'index'])->name('available-services');
Route::get('/service-category', [ServiceCategoryController::class, 'index'])->name('service-category');
Route::get('/service-provider-profile/{userId}', [ServiceProviderProfileController::class, 'index'])->name('service-provider-profile');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');

Route::get('/booking-service', [BookServiceController::class, 'index'])->middleware('auth')->name('booking-service');

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});

//^ Route for Terms and Conditions
Route::get('/terms-and-conditions', function () {
    $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();
    return view('frontend.layouts.terms_and_conditions.index', compact('terms_and_conditions'));
})->name('terms-and-conditions');

//& Route for Privacy Policy
Route::get('/privacy-policy', function () {
    $privacyPolicy = Content::where('type', 'privacyPolicy')->first();
    return view('frontend.layouts.privacy_policy.index', compact('privacyPolicy'));
})->name('privacy-policy');

//* This Route is for Dynamic Page in the frontend footer
Route::get('/page/{page_slug}', [DynamicPageController::class, 'index'])->name('custom.page');
