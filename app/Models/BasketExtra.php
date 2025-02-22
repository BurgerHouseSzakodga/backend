<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketExtra extends Model
{
    protected $fillable = [
        'basket_item_id',
        'ingredient',
        'modification_type',
        'quantity'
    ];

    public function basketItem()
    {
        return $this->belongsTo(BasketItem::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient');
    }
}
