<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Ordercontroller; // BẮT BUỘC PHẢI CÓ

Route::get('/', [HomeController::class, 'index']);

Route::get('/gio-hang', [OrderController::class, 'order'])->name('order');
Route::post('/cart/delete', [OrderController::class, 'cartdelete'])->name('cartdelete');
Route::post('/order/create', [OrderController::class, 'ordercreate'])
    ->middleware('auth')
    ->name('ordercreate');

require __DIR__.'/auth.php';