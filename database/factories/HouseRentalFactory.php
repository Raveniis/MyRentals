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
            'user_id' =>fake()->numberBetween(1,5),
            'name' => Str::random(20),
            'description' => Str::random(20),
            'address' => fake()->address(),
            'monthly_rent' => fake()->randomFloat(2, 8000, 30000),
            'maximum_occupants' => fake()->numberBetween(2,8),
            'image' => fake()->url()
        ];
    }
}
