<?php

use App\Http\Controllers\Web\Backend\Settings\DynamicPageController;
use App\Http\Controllers\Web\Backend\Settings\IntegrationController;
use App\Http\Controllers\Web\Backend\Settings\MailSettingsController;
use App\Http\Controllers\Web\Backend\Settings\PrivacyPolicyController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SocialMediaController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingsController;
use App\Http\Controllers\Web\Backend\Settings\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;

//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile.setting');
    Route::patch('/update-profile', 'UpdateProfile')->name('update.profile');
    Route::put('/update-profile-password', 'UpdatePassword')->name('update.Password');
    Route::post('/update-profile-picture', 'UpdateProfilePicture')->name('update.profile.picture');
    Route::post('/update-cover-photo', 'UpdateCoverPhoto')->name('update.cover.photo');
});

//! Route for System Settings
Route::controller(SystemSettingsController::class)->group(function () {
    Route::get('/system-setting', 'index')->name('system.index');
    Route::patch('/system-setting', 'update')->name('system.update');
});

//! Route for Mail Settings
Route::controller(MailSettingsController::class)->group(function () {
    Route::get('/mail-setting', 'index')->name('mail.setting');
    Route::patch('/mail-setting', 'update')->name('mail.update');
});

//! Route for Integration Settings
Route::controller(IntegrationController::class)->group(function () {
    Route::get('/integration-setting', 'index')->name('integration.setting');
    Route::patch('/google-setting', 'updateGoogleCredentials')->name('google.update');
    Route::patch('/facebook-setting', 'updateFacebookCredentials')->name('facebook.update');
    Route::patch('/stripe-setting', 'updateStripeCredentials')->name('stripe.update');
});

//! Route for SocialMedia Settings
Route::controller(SocialMediaController::class)->group(function () {
    Route::get('/social-media', 'index')->name('social.index');
    Route::post('/social-media', 'update')->name('social.update');
    Route::delete('/social-media/{id}', 'destroy')->name('social.delete');
});

//! Route for Dynamic Page Settings
Route::controller(DynamicPageController::class)->name('settings.')->group(function () {
    Route::get('/dynamic-page', 'index')->name('dynamic_page.index');
    Route::get('/dynamic-page/create', 'create')->name('dynamic_page.create');
    Route::post('/dynamic-page/store', 'store')->name('dynamic_page.store');
    Route::get('/dynamic-page/edit/{id}', 'edit')->name('dynamic_page.edit');
    Route::patch('/dynamic-page/update/{id}', 'update')->name('dynamic_page.update');
    Route::get('/dynamic-page/status/{id}', 'status')->name('dynamic_page.status');
    Route::delete('/dynamic-page/delete/{id}', 'destroy')->name('dynamic_page.destroy');
});

//! Route for Terms $ Conditions
Route::controller(TermsAndConditionsController::class)->group(function () {
    Route::get('/terms-and-conditions', 'index')->name('terms-and-conditions.index');
    Route::patch('/terms-and-conditions', 'update')->name('terms-and-conditions.update');
});

//! Route for Privacy Policy
Route::controller(PrivacyPolicyController::class)->group(function () {
    Route::get('/privacy-policy', 'index')->name('privacy-policy.index');
    Route::patch('/privacy-policy', 'update')->name('privacy-policy.update');
});
