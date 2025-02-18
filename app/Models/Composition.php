<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    protected $fillable = [
        'ingredient_id',
        'menu_item_id',
    ];


    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
