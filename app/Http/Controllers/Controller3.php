<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller3 extends Controller
{
    // Hiển thị trang chi tiết sản phẩm
    public function show($id)
    {
        $categories = DB::table('danh_muc_laptop')->get();
        $laptop = DB::table('san_pham')->where('id', $id)->first();

        if (!$laptop) abort(404);

        $title = $laptop->ten;
        return view('laptop.detail', compact('laptop', 'categories', 'title'));
    }

    // Xử lý thêm vào giỏ hàng (Câu 3)
    public function addToCart(Request $request)
    {
        $id = $request->laptop_id;
        $quantity = $request->quantity;

        $product = DB::table('san_pham')->where('id', $id)->first();

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "ten" => $product->ten,
                "quantity" => $quantity,
                "gia" => $product->gia,
                "hinh_anh" => $product->hinh_anh
            ];
        }

        // Lưu lại session
        session()->put('cart', $cart);

        // Quay lại trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Đã thêm vào giỏ!');
    }
}