<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemExtra extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'ingredient_id',
        'modification_type',
        'quantity',
    ];
}
