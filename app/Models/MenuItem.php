<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image_path',
        'price',
        'discount_amount'
    ];

    protected $appends = ['category_name', 'actual_price'];

    public function getActualPriceAttribute()
    {
        if ($this->discount_amount > 0) {
            return (int) ($this->price - ($this->price * ($this->discount_amount / 100)));
        }
        return (int) $this->price;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function compositions()
    {
        return $this->hasMany(Composition::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category_id ? $this->category->name : null;
    }
}
