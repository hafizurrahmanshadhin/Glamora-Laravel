<?php

use App\Http\Controllers\Web\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Auth\BusinessInformationController;
use App\Http\Controllers\Web\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Web\Auth\EmailVerificationController;
use App\Http\Controllers\Web\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Web\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Web\Auth\JoinController;
use App\Http\Controllers\Web\Auth\NewPasswordController;
use App\Http\Controllers\Web\Auth\PasswordController;
use App\Http\Controllers\Web\Auth\PasswordResetLinkController;
use App\Http\Controllers\Web\Auth\PhoneNumberVerificationController;
use App\Http\Controllers\Web\Auth\QuestionnairesController;
use App\Http\Controllers\Web\Auth\RegisteredUserController;
use App\Http\Controllers\Web\Auth\VerificationSuccessController;
use App\Http\Controllers\Web\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/join', [JoinController::class, 'create'])->name('join');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::controller(PhoneNumberVerificationController::class)
        ->group(function () {
            Route::get('phone-number-verification', 'index')->name('phone-number-verification');
            Route::post('send-sms-otp', 'sendOtpToPhone')->name('send-sms-otp');
            Route::get('phone-otp-verification', 'otpVerificationView')->name('phone-otp-verification');
            Route::post('verify-sms-otp', 'verifyOtpForPhone')->name('verify-sms-otp');
        });

    Route::controller(EmailVerificationController::class)
        ->group(function () {
            Route::get('/email-verification', 'index')->name('email-verification');
            Route::post('/send-otp', 'sendOtpToEmail')->name('send-otp');
            Route::get('/otp-verification', 'otpVerificationView')->name('otp-verification');
            Route::post('/verify-otp', 'verifyOTP')->name('verify-otp');
        });

    Route::get('verification-success', [VerificationSuccessController::class, 'index'])->name('verification-success');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware(['auth', 'allow_beauty_expert'])->group(function () {
    Route::get('/questionnaires', [QuestionnairesController::class, 'index'])->name('questionnaires');
    Route::get('/business-information', [BusinessInformationController::class, 'index'])->name('business-information');
    Route::post('/business-information/store', [BusinessInformationController::class, 'store'])->name('business-information.store');
    Route::post('/business-information/save-location', [BusinessInformationController::class, 'storeLocation'])
        ->name('businessInformation.storeLocation');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/profile-submitted', function () {
    return view('auth.layouts.profile-submitted');
})->name('profile-submitted');
