<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


use App\Http\Controllers\LaptopController7;
Route::get('/quanly', [LaptopController7::class, 'quanly']);
Route::delete('/quanly/xoa/{id}', [LaptopController7::class, 'destroy']);

use App\Http\Controllers\controller2;


Route::get('/', [controller2::class, 'index']);
Route::get('/laptop/theloai/{id_danh_muc}', [controller2::class, 'index']);



use App\Http\Controllers\controller3;

Route::get('/laptop/chitiet/{id}', [controller3::class, 'show'])->name('laptop.detail');


Route::post('/them-gio-hang', [controller3::class, 'addToCart'])->name('cart.add');
