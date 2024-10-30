<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
         'shirt_id', // Sửa từ shirt_id thành product_id
        'manufacturer', // Thêm trường manufacturer
        'size', // Thêm trường size
        'material', // Thêm trường material
        'price', // Thêm trường price
        'quantity',
    ];

    // Định nghĩa mối quan hệ với bảng users (nếu có)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định nghĩa mối quan hệ với bảng shirts
    public function shirt()
    {
        return $this->belongsTo(Shirt::class, 'shirt_id'); // Chỉ rõ trường khóa ngoại là shirt_id
    }
}
