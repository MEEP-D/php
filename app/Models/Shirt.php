<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'size',
        'material',
        'price',
        'quantity',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'shirt_id'); // Định nghĩa mối quan hệ một-nhiều
    }
}
