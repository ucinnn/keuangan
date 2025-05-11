<?php

use App\Http\Controllers\tupusat\auth\LoginController;
use App\Http\Controllers\tupusat\auth\TupusatAuthenticatedSessionController;
use App\Http\Controllers\tupusat\auth\ConfirmablePasswordController;
use App\Http\Controllers\tupusat\auth\EmailVerificationNotificationController;
use App\Http\Controllers\tupusat\auth\EmailVerificationPromptController;
use App\Http\Controllers\tupusat\auth\NewPasswordController;
use App\Http\Controllers\tupusat\auth\PasswordController;
use App\Http\Controllers\tupusat\auth\ForgotPasswordController;
use App\Http\Controllers\tupusat\auth\RegisteredUserController;
use App\Http\Controllers\tupusat\auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::prefix('tupusat')->middleware('guest')->group(function () {
    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('tupusat.password.request');

    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('tupusat.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('tupusat.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('tupusat.password.store');

    Route::get('login', [LoginController::class, 'create'])->name('tupusat.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('tupusat')->middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('tupusat.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('tupusat.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('tupusat.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('tupusat.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('tupusat.password.update');

    Route::post('logout', [TupusatAuthenticatedSessionController::class, 'destroy'])
        ->name('tupusat.logout');
});
