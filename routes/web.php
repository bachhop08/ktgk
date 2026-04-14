<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

use App\Http\Controllers\controller2;

// Câu 2
Route::get('/', [controller2::class, 'index']);
Route::get('/laptop/theloai/{id_danh_muc}', [controller2::class, 'index']);

// Câu 3
Route::get('/laptop/chitiet/{id}', [controller2::class, 'show'])->name('laptop.detail');
use App\Http\Controllers\controller3;

// Route xem chi tiết
Route::get('/laptop/chitiet/{id}', [controller3::class, 'show'])->name('laptop.detail');

// Route xử lý thêm giỏ hàng
Route::post('/them-gio-hang', [controller3::class, 'addToCart'])->name('cart.add');