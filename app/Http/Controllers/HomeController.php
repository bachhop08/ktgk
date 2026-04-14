<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Laptop;

class HomeController extends Controller

{

public function index()
{
    $laptops = Laptop::paginate(12);
    $keyword = ''; // Khởi tạo biến trống để tránh lỗi Undefined
    return view('laptop.index', compact('laptops', 'keyword'));
}
}
