<?php

use App\Http\Controllers\tuunit\Auth\LoginController;
use App\Http\Controllers\tuunit\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('tuunit')->middleware('guest:tuunit')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('tuunit.register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('tuunit.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('tuunit')->middleware('auth:tuunit')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
