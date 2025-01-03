<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user',
        'status',
        'total',
        'created_at'
    ];
}
