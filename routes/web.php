<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeController;

Route::view('/login', 'auth.login')->name('login');

Route::group(['middleware' => 'admin'], function() {
    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
});

Route::post('/payment', [App\Https\Controllers\OrderController::class, 'payment'])->name('razorpay.payment.store');