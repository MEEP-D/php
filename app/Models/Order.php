<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_phone',
        'total',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class); // Hoặc tên mô hình của bạn
    }

}
