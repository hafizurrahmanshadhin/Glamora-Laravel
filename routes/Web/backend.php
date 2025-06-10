<?php

use App\Http\Controllers\Web\Backend\AfterPaymentController;
use App\Http\Controllers\Web\Backend\AuthPageImageController;
use App\Http\Controllers\Web\Backend\BeautyExpertController;
use App\Http\Controllers\Web\Backend\BeforePaymentController;
use App\Http\Controllers\Web\Backend\ClientController;
use App\Http\Controllers\Web\Backend\CMS\JoinUsController;
use App\Http\Controllers\Web\Backend\CMS\QuestionnairesController;
use App\Http\Controllers\Web\Backend\CMS\ServiceTypeController;
use App\Http\Controllers\Web\Backend\ContactController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\FAQController;
use App\Http\Controllers\Web\Backend\HomePageImageController;
use App\Http\Controllers\Web\Backend\ImageApprovalRequestController;
use App\Http\Controllers\Web\Backend\NewsletterSubscriptionController;
use App\Http\Controllers\Web\Backend\ReportController;
use App\Http\Controllers\Web\Backend\ServiceController;
use App\Http\Controllers\Web\Backend\TestimonialController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//! Route for Users Beauty Expert Page
Route::controller(BeautyExpertController::class)->prefix('user')->group(function () {
    Route::get('/beauty-expert', 'index')->name('user.beauty-expert.index');
    Route::get('/beauty-expert/show/{id}', 'show')->name('user.beauty-expert.show');
    Route::post('/beauty-expert/status/{id}', 'status')->name('user.beauty-expert.status');
    Route::delete('/beauty-expert/destroy/{id}', 'destroy')->name('user.beauty-expert.destroy');
});

//! Route for Users Client Page
Route::controller(ClientController::class)->prefix('user')->group(function () {
    Route::get('/client', 'index')->name('user.client.index');
    Route::get('/client/show/{id}', 'show')->name('user.client.show');
    Route::post('/client/status/{id}', 'status')->name('user.client.status');
    Route::delete('/client/destroy/{id}', 'destroy')->name('user.client.destroy');
});

//! Route for Service Backend
Route::controller(ServiceController::class)->group(function () {
    Route::get('/service', 'index')->name('service.index');
    Route::post('/service/store', 'store')->name('service.store');
    Route::put('/service/update/{id}', 'update')->name('service.update');
    Route::get('/service/status/{id}', 'status')->name('service.status');
    Route::delete('/service/destroy/{id}', 'destroy')->name('service.destroy');
});

//! Route for Image Approval Request Page
Route::controller(ImageApprovalRequestController::class)->group(function () {
    Route::get('/image-approval-request', 'index')->name('image-approval-request.index');
    Route::post('/image-approval-request/status/{userGallery}', 'status')->name('image-approval-request.status');
});

//! Route for FAQ Page
Route::controller(FAQController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq.index');
    Route::get('/faq/show/{id}', 'show')->name('faq.show');
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
    Route::get('/contacts/show/{id}', 'show')->name('contacts.show');
    Route::get('/contacts/status/{id}', 'status')->name('contacts.status');
    Route::delete('/contacts/destroy/{id}', 'destroy')->name('contacts.destroy');
});

//! Route for Testimonial Page
Route::controller(TestimonialController::class)->group(function () {
    Route::get('/testimonial', 'index')->name('testimonial.index');
    Route::get('/testimonial/show/{id}', 'show')->name('testimonial.show');
    Route::post('/testimonial/status/{id}', 'status')->name('testimonial.status');
});

//! Route for Report Page
Route::controller(ReportController::class)->group(function () {
    Route::get('/report', 'index')->name('report.index');
    Route::get('/report/show/{id}', 'show')->name('report.show');
});

//! Route for Newsletter Subscriptions Page
Route::controller(NewsletterSubscriptionController::class)->group(function () {
    Route::get('/newsletter-subscription', 'index')->name('newsletter-subscription.index');
    Route::get('/newsletter-subscription/status/{id}', 'status')->name('newsletter-subscription.status');
    Route::delete('/newsletter-subscription/destroy/{id}', 'destroy')->name('newsletter-subscription.destroy');
});

//! Route for CMS Pages
Route::prefix('cms')->name('cms.')->group(function () {
    //! Route for Home Page Image
    Route::controller(HomePageImageController::class)->group(function () {
        Route::get('/home-page', 'index')->name('home-page.index');
        Route::post('/home-page/store', 'store')->name('home-page.store');
        Route::delete('/home-page/{id}', 'destroy')->name('home-page.destroy');
    });

    //! Route for Auth Page Image
    Route::controller(AuthPageImageController::class)->group(function () {
        Route::get('/auth-page', 'index')->name('auth-page.index');
        Route::post('/auth-page/store', 'store')->name('auth-page.store');
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
});

//! Booking Cancellation Routes
Route::prefix('booking-cancellation')->group(function () {
    // Before Payment
    Route::controller(BeforePaymentController::class)->group(function () {
        Route::get('/before-payment', 'index')->name('before-payment.index');
        Route::get('/before-payment/show/{id}', 'show')->name('before-payment.show');
    });

    // After Payment
    Route::controller(AfterPaymentController::class)->group(function () {
        Route::get('/after-payment', 'index')->name('after-payment.index');
        Route::post('/ban-user', 'banUser')->name('user.ban');
        Route::post('/comment', 'storeComment')->name('admin-comment');
    });
});
