<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller2 extends Controller
{
    // CÂU 2: Trang chủ và Lọc theo thương hiệu
    public function index(Request $request, $id_danh_muc = null)
    {
        // 1. Lấy danh sách thương hiệu (Layout dùng biến $categories)
        $categories = DB::table('danh_muc_laptop')->get();

        // 2. Truy vấn laptop
        $query = DB::table('san_pham');

        if ($id_danh_muc) {
            $query->where('id_danh_muc', $id_danh_muc);
            $title = "Thương hiệu " . DB::table('danh_muc_laptop')->where('id', $id_danh_muc)->value('ten_danh_muc');
        } else {
            $query->limit(20);
            $title = "Trang chủ Laptop";
        }

        // 3. Sắp xếp giá
        if ($request->has('sort')) {
            $query->orderBy('gia', $request->sort == 'asc' ? 'asc' : 'desc');
        }

        $laptops = $query->get();

        // Trả về view theo chuẩn layout (biến categories truyền vào để header lặp)
        return view('laptop.index', compact('laptops', 'categories', 'title', 'id_danh_muc'));
    }

    // CÂU 3: Chi tiết sản phẩm
    public function show($id)
    {
        $categories = DB::table('danh_muc_laptop')->get();
        $laptop = DB::table('san_pham')->where('id', $id)->first();

        if (!$laptop) abort(404);

        $title = $laptop->ten;

        return view('laptop.detail', compact('laptop', 'categories', 'title'));
    }
}