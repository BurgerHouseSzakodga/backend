<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    protected $fillable = [
        'basket_id',
        'item_id',
        'item',
        'quantity'
    ];

    public function extras()
    {
        return $this->hasMany(BasketExtra::class, 'basket_item_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'item_id');
    }
}
