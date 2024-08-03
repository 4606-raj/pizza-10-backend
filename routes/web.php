<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('payment-test');
});

Route::post('/payment', [App\Https\Controllers\OrderController::class, 'payment'])->name('razorpay.payment.store');