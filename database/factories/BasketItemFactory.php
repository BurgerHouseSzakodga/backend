<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasketItemFactory extends Factory
{
    protected $model = BasketItem::class;

    public function definition()
    {
        return [
            'basket_id' => Basket::factory(),
            'item_id' => MenuItem::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'buying_price' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
