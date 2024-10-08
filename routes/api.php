<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('index', [HomeController::class, 'index']);
Route::get('show/{id}', [HomeController::class, 'show']);
Route::get('menu', [HomeController::class, 'menu']);
Route::get('toppings', [HomeController::class, 'toppingsList']);
Route::get('offers', [HomeController::class, 'offers']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart', [CartController::class, 'store']);
    Route::delete('cart', [CartController::class, 'destroy']);
    Route::post('increase', [CartController::class, 'increase']);

    Route::get('address', [HomeController::class, 'getAddresses']);
    Route::post('address', [HomeController::class, 'storeAddress']);
    Route::PUT('address', [HomeController::class, 'updateAddress']);
    Route::delete('address\{id}', [HomeController::class, 'destroyAddress']);
    

    Route::post('order', [OrderController::class, 'store']);
    Route::get('order', [OrderController::class, 'index']);
    Route::post('razor-pay-order', [OrderController::class, 'razorPayCreateOrder']);
    Route::post('order-payment-confirmation', [OrderController::class, 'orderPaymentConfirmation']);

    Route::get('get-profile', [AuthController::class, 'getProfile']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('apply-offer', [CartController::class, 'applyOffer']);
});


Route::get('delete-user-data', function() {
    return true;
});