<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController7;
use App\Http\Controllers\Controller2;
use App\Http\Controllers\Controller3;
use App\Http\Controllers\OrderController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/quanly', [LaptopController7::class, 'quanly']);
Route::delete('/quanly/xoa/{id}', [LaptopController7::class, 'destroy']);

Route::get('/', [Controller2::class, 'index']);
Route::get('/laptop/theloai/{id_danh_muc}', [Controller2::class, 'index']);

Route::get('/laptop/chitiet/{id}', [Controller3::class, 'show'])->name('laptop.detail');

Route::post('/them-gio-hang', [Controller3::class, 'addToCart'])->name('cart.add');

Route::get('/gio-hang', [OrderController::class, 'order'])->name('order');

Route::post('/cart/delete', [OrderController::class, 'cartdelete'])->name('cartdelete');

Route::post('/order/create', [OrderController::class, 'ordercreate'])
    ->middleware('auth')
    ->name('ordercreate');