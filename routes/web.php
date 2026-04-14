<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

use App\Http\Controllers\LaptopController7;
Route::get('/quanly', [LaptopController7::class, 'quanly']);
Route::delete('/quanly/xoa/{id}', [LaptopController7::class, 'destroy']);
