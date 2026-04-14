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
        // ... code của hàm order
    }

    public function cartdelete(Request $request)
    {
        // ... code của hàm cartdelete
    }

    public function ordercreate(Request $request)
    {
        // ... code của hàm ordercreate
    }

    // ==========================================
    // DÁN HÀM TEST MAIL VÀO ĐÂY (BÊN TRONG CLASS)
    // ==========================================
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

} // <--- DẤU NGOẶC NHỌN NÀY LÀ KẾT THÚC CỦA CLASS, HÀM TEST MAIL PHẢI NẰM TRÊN NÓ