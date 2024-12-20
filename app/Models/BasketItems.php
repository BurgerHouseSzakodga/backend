<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket_items extends Model
{
    protected $fillable=[
        'basket_id',
        'item',
        'quantity'
    ];
}
