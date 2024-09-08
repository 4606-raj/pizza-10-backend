<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OfferController;

Route::view('/login', 'auth.login')->name('login');

Route::group(['middleware' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() {
    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('staff', StaffController::class);
    Route::get('/offers/settings/{offerId}', [OfferController::class, 'settingsPage'])->name('offers.settings.create');
    Route::post('/offers/settings', [OfferController::class, 'settingsStore'])->name('offers.settings.store');
});

Route::post('/payment', [App\Https\Controllers\OrderController::class, 'payment'])->name('razorpay.payment.store');

Route::get('/test', function() {
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");

    $client = new Twilio\Rest\Client($account_sid, $auth_token);
    
    $client->messages->create('+919815134606', 
            ['from' => $twilio_number, 'body' => 'test'] );
});