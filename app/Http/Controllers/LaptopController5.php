<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;

class LaptopController5 extends Controller 
{
    public function search(Request $request)
    {
        // Lấy keyword, nếu không có thì gán là chuỗi rỗng
        $keyword = $request->input('keyword', ''); 

        $query = Laptop::query();

        if ($keyword) {
            $query->where('tieu_de', 'LIKE', "%{$keyword}%");
        }

        $laptops = $query->paginate(12);

        // Trả về view và truyền dữ liệu
        return view('laptop.index', compact('laptops', 'keyword'));
    }
} // Kết thúc bằng dấu ngoặc nhọn, KHÔNG có dấu phẩy