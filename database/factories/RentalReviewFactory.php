<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalReview>
 */
class RentalReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reviewed_by' => fake()->numberBetween(6,10),
            'rental_id' => fake()->numberBetween(1,10),
            'ratings' => fake()->numberBetween(1,5),
            'comment' => fake()->sentence()
        ];
    }
}
