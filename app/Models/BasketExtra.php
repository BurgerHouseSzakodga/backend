<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketExtra extends Model
{
    protected $fillable=[
        'basket_id',
        'foods',
        'ingredient',
        'modification_type',
        'quantity'

    ];
}
