<?php

namespace Database\Factories;

use App\Models\Basket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Basket>
 */
class BasketFactory extends Factory
{
    protected $model = Basket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => User::factory(),
            'total_amount' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
