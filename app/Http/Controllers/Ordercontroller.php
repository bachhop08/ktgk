<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Mail\OrderSuccessMail;        

class OrderController extends Controller
{
    public function order()
    {
        $categories = DB::table('danh_muc_laptop')->get();
        $cart = session('cart', []);
        
        if (!empty($cart)) {
            $data = DB::table('san_pham')->whereIn('id', array_keys($cart))->get();
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
            'tinh_trang' => 1 
        ]);
        $mailData = []; 
        foreach ($cart as $id => $qty) {
            $laptop = DB::table('san_pham')->where('id', $id)->first();
            $so_luong_thuc_te = is_array($qty) ? ($qty['quantity'] ?? $qty['so_luong'] ?? 1) : $qty;

            if ($laptop) {
                DB::table('chi_tiet_don_hang')->insert([
                    'ma_don_hang' => $orderId,
                    'laptop_id'   => $id,
                    'so_luong'    => $so_luong_thuc_te, 
                    'don_gia'     => $laptop->gia
                ]);
            
                $mailData[] = [
                    'ten_laptop' => $laptop->tieu_de, 
                    'so_luong'   => $so_luong_thuc_te,
                    'don_gia'    => $laptop->gia
                ];
            }
        }
        
        try {
            Mail::to(Auth::user()->email)->send(new OrderSuccessMail($mailData));
        } catch (\Exception $e) {
            
        }
       
        session()->forget('cart');
        return redirect()->route('order')->with('success', 'Đặt hàng thành công! Một email xác nhận đã được gửi đến bạn. Mã đơn hàng: #' . $orderId);
    }


    public function testMail()
    {
        $mailData = [
            [
                'ten_laptop' => 'Laptop Test Gửi Mail',
                'so_luong'   => 1,
                'don_gia'    => 35000000
            ]
        ];

        $emailNhan = Auth::check() ? Auth::user()->email : 'bachhop3108@gmail.com'; 

        try {
            Mail::to($emailNhan)->send(new OrderSuccessMail($mailData));
            return "✅ Tuyệt vời! Đã gửi mail test thành công!";
        } catch (\Exception $e) {
            return "❌ Lỗi không thể gửi mail: " . $e->getMessage();
        }
    }

}