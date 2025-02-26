<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'menu_item_quantity',
        'buying_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function extras()
    {
        return $this->hasMany(OrderItemExtra::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
