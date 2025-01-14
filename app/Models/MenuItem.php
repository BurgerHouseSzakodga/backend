<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image_path',
        'price',
    ];

    protected $appends = ['category_name'];

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
