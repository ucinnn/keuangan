<?php

use App\Http\Controllers\Admin\auth\LoginController;
use App\Http\Controllers\Admin\auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\auth\NewPasswordController;
use App\Http\Controllers\Admin\auth\PasswordController;
use App\Http\Controllers\Admin\auth\ForgotPasswordController;
use App\Http\Controllers\Admin\auth\RegisteredUserController;
use App\Http\Controllers\Admin\auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('admin.password.request');

    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('admin.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('admin.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('admin.password.store');

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('admin.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('admin.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('admin.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});