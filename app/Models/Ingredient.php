<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extra_price',
    ];

    public function extras()
    {
        $this->hasMany(OrderItemExtra::class);
    }
}
