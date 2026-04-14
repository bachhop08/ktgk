<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    // Đổi 'laptop' thành 'san_pham' vì trong database của bạn bảng tên là 'san_pham'
    protected $table = 'san_pham'; 

    // Tắt timestamps nếu bảng san_pham không có cột created_at/updated_at
    public $timestamps = false;
}