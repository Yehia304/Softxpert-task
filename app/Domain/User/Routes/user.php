<?php

use Illuminate\Support\Facades\Route;
use App\Domain\User\Controllers\AuthController;

Route::group(['middleware' => 'guest'], function () {
    Route::post('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/login',[AuthController::class, 'login'])->name('login');
});
