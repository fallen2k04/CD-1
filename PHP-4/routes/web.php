<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('orders.index');
});

Route::resource('orders', OrderController::class);
Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
