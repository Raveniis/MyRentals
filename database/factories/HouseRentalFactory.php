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
            'name' => fake()->name(),
            'description' => Str::random(20),
            'address' => fake()->address(),
            'price' => 200.90,
            'maximum_occupants' => 8,
            'status' => 1,
        ];
    }
}
