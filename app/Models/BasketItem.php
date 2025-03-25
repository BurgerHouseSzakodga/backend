<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'item_id',
        'item',
        'buying_price'
    ];

    public function extras()
    {
        return $this->hasMany(BasketExtra::class, 'basket_item_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'item_id');
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}
