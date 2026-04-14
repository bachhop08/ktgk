<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController5;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// Route cho Profile
Route::get('/profile', function () {
    return view('profile'); 
})->name('account'); 

// Route tìm kiếm - Sửa đường dẫn cho chuẩn
Route::post('/timkiem', [LaptopController5::class, 'search'])->name('laptop.search');