<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['készül', 'kiszállítva']),
            'total' => $this->faker->numberBetween(1000, 10000),
            'delivery_address' => $this->faker->boolean ? $this->faker->address : null,
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
