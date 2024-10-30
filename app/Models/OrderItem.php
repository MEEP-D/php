<?php

// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'shirt_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    // Trong model Order
public function items()
{
    return $this->hasMany(OrderItem::class); // Hoặc tên model phù hợp
}


    public function shirt()
    {
        return $this->belongsTo(Shirt::class);
    }
}
