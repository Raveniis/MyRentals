<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseRental>
 */
class HouseRentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(20),
            'description' => Str::random(20),
            'address' => fake()->address(),
            'price' => fake()->randomFloat(2, 8000, 30000),
            'maximum_occupants' => fake()->numberBetween(2,8),
            'status' => fake()->numberBetween(0,1),
        ];
    }
}
