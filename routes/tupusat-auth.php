<?php

use App\Http\Controllers\tupusat\Auth\LoginController;
use App\Http\Controllers\tupusat\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('tupusat')->middleware('guest:tupusat')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('tupusat.register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('tupusat.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('tupusat')->middleware('auth:tupusat')->group(function () {

    Route::get('/dashboard', function () {
        return view('tupusat.dashboard');
    })->name('tupusat.dashboard');

    Route::get('/manage-biaya', action: function () {
        return view('tupusat.manage-biaya');
    })->name('tupusat.manage-biaya');


    Route::post('logout', [LoginController::class, 'destroy'])->name('tupusat.logout');
});
