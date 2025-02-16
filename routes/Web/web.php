<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Frontend\AvailableServicesController;
use App\Http\Controllers\Web\Frontend\BookServiceController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\DynamicPageController;
use App\Http\Controllers\Web\Frontend\FAQController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\LegalPageController;
use App\Http\Controllers\Web\Frontend\MessageController;
use App\Http\Controllers\Web\Frontend\NewsletterSubscriptionController;
use App\Http\Controllers\Web\Frontend\NotificationController;
use App\Http\Controllers\Web\Frontend\PaymentController;
use App\Http\Controllers\Web\Frontend\ServiceCategoryController;
use App\Http\Controllers\Web\Frontend\ServiceProviderProfileController;
use Illuminate\Support\Facades\Route;

// Route for Reset Database and Optimize Clear
Route::get('/reset', [ResetController::class, 'RunMigrations'])->name('reset');

// Route for Landing Page
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/available-services/{serviceId}', [AvailableServicesController::class, 'index'])->name('available-services');
Route::get('/service-category', [ServiceCategoryController::class, 'index'])->name('service-category');
Route::get('/service-provider-profile/{userId}/service/{serviceId}', [ServiceProviderProfileController::class, 'index'])->name('service-provider-profile');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');

Route::controller(BookServiceController::class)->middleware(['auth'])->group(function () {
    Route::get('/booking-service', 'index')->name('booking-service');
    Route::post('/booking-store', 'store')->name('booking.store');
    Route::get('/booking-service/negotiate/{booking}', 'viewNegotiate')->name('negotiate-request');
    Route::post('/booking-service/respond-availability', 'respondAvailability')->name('booking.respondAvailability');
});

Route::controller(PaymentController::class)->middleware(['auth'])->group(function () {
    Route::get('/make-payment/{booking}', 'makePayment')->name('make-payment');
    Route::post('/checkout/{booking}', 'checkout')->name('checkout');
    Route::get('/payment-success/{booking}', 'success')->name('payment.success');
    Route::get('/payment-cancel', 'cancel')->name('payment.cancel');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});

// Route for Newsletter Subscription
Route::post('/newsletter-subscription', [NewsletterSubscriptionController::class, 'store'])->name('newsletter-subscription.store');

// Route for Notification
Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');

// Route for Terms and Conditions, Privacy Policy, Inclusions and Cancellation Policy
Route::controller(LegalPageController::class)->group(function () {
    Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/inclusions-cancellation', 'inclusionsCancellation')->name('inclusions-cancellation');
});

// This Route is for Dynamic Page in the frontend footer
Route::get('/page/{page_slug}', [DynamicPageController::class, 'index'])->name('custom.page');

// Route for Chatting Message
Route::controller(MessageController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/chat/{id}', 'show')->name('chat');
    Route::post('/chat/send', 'sendMessage')->name('chat.send');
});
