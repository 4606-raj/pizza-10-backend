<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OfferController;

Route::view('/login', 'auth.login')->name('login');

Route::group(['middleware' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() {
    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::get('users-export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('users.export');
    Route::resource('orders', OrderController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('menu-categories', CategoryController::class);
    Route::get('menu-items-subcateogries/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesIndex'])->name('menu-items.subcateogries');
    Route::get('menu-items-subcateogries-create/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesCreate'])->name('menu-subcategories.create');
    Route::post('menu-items-subcateogries-store', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesStore'])->name('menu-subcategories.store');
    Route::get('menu-items-subcateogries-edit/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesEdit'])->name('menu-subcategories.edit');
    Route::PUT('menu-items-subcateogries-update/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesUpdate'])->name('menu-subcategories.update');
    Route::delete('menu-items-subcateogries-delete/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'subcateogriesDestroy'])->name('menu-subcategories.destroy');

    Route::get('/offers/settings/{offerId}', [OfferController::class, 'settingsPage'])->name('offers.settings.create');
    Route::post('/offers/settings', [OfferController::class, 'settingsStore'])->name('offers.settings.store');
    Route::get('/offers/settings/remove-menu-item/{offerId}/{menuItemId}/{baseId}', [OfferController::class, 'settingsRemoveMenuItem'])->name('offers.settings.remove-menu-items');
    Route::get('/offers/settings/remove-all-menu-item/{offerId}', [OfferController::class, 'settingsRemoveAllMenuItem'])->name('offers.settings.remove-all-menu-items');
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