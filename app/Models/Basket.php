<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'basket_id',
        'user',
        'total_amount'
    ];
}
