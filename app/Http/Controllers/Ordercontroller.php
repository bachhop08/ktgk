<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Thêm thư viện Mail
use App\Mail\OrderSuccessMail;        // Thêm lớp Mail sẽ tạo ở bước 2

class OrderController extends Controller
{
    public function order()
    {
        $categories = DB::table('danh_muc_laptop')->get();
        $cart = session('cart', []);
        
        if (!empty($cart)) {
            $data = DB::table('laptop')->whereIn('id', array_keys($cart))->get();
            $quantity = $cart;
        } else {
            $data = collect();
            $quantity = [];
        }
        return view('laptop.order', [
            'data' => $data,
            'quantity' => $quantity,
            'categories' => $categories,
            'title' => 'Giỏ hàng'
        ]);
    }
    public function cartdelete(Request $request)
    {
        $cart = session('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
    public function ordercreate(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        $orderId = DB::table('don_hang')->insertGetId([
            'user_id' => Auth::id(),
            'ngay_dat_hang' => now(),
            'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
            'tinh_trang' => 1 // Trạng thái: Mới đặt
        ]);
        $mailData = []; 
        // 2. Lưu chi tiết đơn hàng
        foreach ($cart as $id => $qty) {
            $laptop = DB::table('laptop')->where('id', $id)->first();
            if ($laptop) {
                DB::table('chi_tiet_don_hang')->insert([
                    'ma_don_hang' => $orderId,
                    'laptop_id'   => $id,
                    'so_luong'    => $qty,
                    'don_gia'     => $laptop->gia
                ]);
                // Thu thập dữ liệu để gửi mail
                $mailData[] = [
                    'ten_laptop' => $laptop->ten,
                    'so_luong'   => $qty,
                    'don_gia'    => $laptop->gia
                ];
            }
        }
        // 3. Gửi email xác nhận
        try {
            Mail::to(Auth::user()->email)->send(new OrderSuccessMail($mailData));
        } catch (\Exception $e) {
            // Nếu lỗi gửi mail thì vẫn tiếp tục để không làm gián đoạn trải nghiệm khách hàng
            // \Log::error("Lỗi gửi mail: " . $e->getMessage());
        }
        // 4. Xóa giỏ hàng
        session()->forget('cart');
        return redirect()->route('order')->with('success', 'Đặt hàng thành công! Một email xác nhận đã được gửi đến bạn. Mã đơn hàng: #' . $orderId);
    }
}