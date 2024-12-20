<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    protected $fillable=[
        'basket_id',
        'user',
        'total_amount'
    ];
}
