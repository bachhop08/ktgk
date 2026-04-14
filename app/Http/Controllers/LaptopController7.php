<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController7 extends Controller
{
    public function quanly()
    {
        $products = DB::table('san_pham')
            ->join('danh_muc_laptop', 'san_pham.id_danh_muc', '=', 'danh_muc_laptop.id')
            ->where('san_pham.status', 1)
            ->select('san_pham.*', 'danh_muc_laptop.ten_danh_muc')
            ->orderBy('san_pham.id', 'desc')
            ->get();

        
        return view('components.quanly', compact('products'));
    }

    public function destroy($id)
    {
        DB::table('san_pham')->where('id', $id)->update(['status' => 0]);
        return redirect('/quanly')->with('success', 'Đã xóa thành công!');
    }
        public function timkiem(Request $request)
    {
        $keyword = $request->input('keyword');  
        $products = DB::table('san_pham')
            ->join('danh_muc_laptop', 'san_pham.id_danh_muc', '=', 'danh_muc_laptop.id')
            ->where('san_pham.status', 1)
            ->where(function($query) use ($keyword) {
                $query->where('san_pham.tieu_de', 'like', '%' . $keyword . '%')
                      ->orWhere('san_pham.cpu', 'like', '%' . $keyword . '%')
                      ->orWhere('san_pham.ram', 'like', '%' . $keyword . '%');
            })
            ->select('san_pham.*', 'danh_muc_laptop.ten_danh_muc')
            ->orderBy('san_pham.id', 'desc')
            ->get();
        return view('components.quanly', compact('products', 'keyword'));
    }
}

