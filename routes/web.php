<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\StaffController;

Route::view('/login', 'auth.login')->name('login');

Route::group(['middleware' => 'admin'], function() {
    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('staff', StaffController::class);
});

Route::post('/payment', [App\Https\Controllers\OrderController::class, 'payment'])->name('razorpay.payment.store');