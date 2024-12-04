<?php

use App\Http\Controllers\tupusat\Auth\LoginController;
use App\Http\Controllers\tupusat\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('tupusat')->middleware('guest:tupusat')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('tupusat.register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('tupusat.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('tupusat')->middleware('auth:tupusat')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])->name('tupusat.logout');
});