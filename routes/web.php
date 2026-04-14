<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

require __DIR__.'/auth.php';

Route::get('/gio-hang', 'App\Http\Controllers\Ordercontroller@order')->name('order');
Route::post('/cart/delete', 'App\Http\Controllers\Ordercontroller@cartdelete')->name('cartdelete');
Route::post('/order/create', 'App\Http\Controllers\Ordercontroller@ordercreate')->middleware('auth')->name('ordercreate');