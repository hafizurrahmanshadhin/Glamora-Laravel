<?php

use App\Http\Controllers\Web\Backend\CMS\AuthPageImageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageBannerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageImageController;
use App\Http\Controllers\Web\Backend\CMS\JoinUsController;
use App\Http\Controllers\Web\Backend\CMS\ProfileReviewMessageController;
use App\Http\Controllers\Web\Backend\CMS\QuestionMarkTextController;
use App\Http\Controllers\Web\Backend\CMS\QuestionnairesController;
use App\Http\Controllers\Web\Backend\CMS\ServiceTypeController;
use App\Http\Controllers\Web\Backend\CMS\TestimonialImageController;
use App\Http\Controllers\Web\Backend\CMS\UserDashboardController;
use Illuminate\Support\Facades\Route;

//! Route for User Dashboard Page
Route::controller(UserDashboardController::class)->prefix('user-dashboard')->name('user-dashboard.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'update')->name('update');
});

//! Route for User Question Mark Text Page
Route::controller(QuestionMarkTextController::class)->prefix('question-mark-text')->name('question-mark-text.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'update')->name('update');
});

//! Route for User Profile Review Message Page
Route::controller(ProfileReviewMessageController::class)->prefix('profile-review-message')->name('profile-review-message.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'update')->name('update');
});

//! Route for Home Page Image
Route::controller(HomePageImageController::class)->group(function () {
    Route::get('/home-page', 'index')->name('home-page.index');
    Route::post('/home-page/store', 'store')->name('home-page.store');
    Route::delete('/home-page/{id}', 'destroy')->name('home-page.destroy');
});

//! Route for Home Page Banner
Route::controller(HomePageBannerController::class)->prefix('home-page-banner')->name('home-page-banner.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'update')->name('update');
});

//! Route for Auth Page Image
Route::controller(AuthPageImageController::class)->group(function () {
    Route::get('/auth-page', 'index')->name('auth-page.index');
    Route::post('/auth-page/store', 'store')->name('auth-page.store');
});

//! Route for Home Page Testimonial Image
Route::controller(TestimonialImageController::class)->group(function () {
    Route::get('/testimonial', 'index')->name('testimonial.index');
    Route::post('/testimonial/store', 'store')->name('testimonial.store');
});

//! Route for questionnaires Page
Route::controller(QuestionnairesController::class)->prefix('questionnaires')->name('questionnaires.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'updateQuestionnaires')->name('update.questionnaires');
    Route::post('/store', 'store')->name('store');
    Route::get('/show/{id}', 'show')->name('show');
    Route::put('/update/{id}', 'update')->name('update');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});

//! Route for Join Us Page
Route::controller(JoinUsController::class)->prefix('join-us')->name('join-us.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/', 'update')->name('update');
});

//! Route for Service Type Page
Route::controller(ServiceTypeController::class)->prefix('service-type')->name('service-type.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/show/{id}', 'show')->name('show');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::get('/status/{id}', 'status')->name('status');
});
