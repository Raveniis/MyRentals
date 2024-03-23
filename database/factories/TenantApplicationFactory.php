<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenantApplication>
 */
class TenantApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'occupants_number' => fake()->numberBetween(2, 8),
            'move_in_date' => fake()->dateTimeBetween('now', '+1 year'),
            'lease_term' => fake()->numberBetween(4, 18),
            'monthly_income' => fake()->randomFloat(2, 12000, 50000),
            'employment_status' => 'employed',   //assumes that all tenant applicants have a job
            'application_status' => 'pending',  //all applicants status is pending
        ];
    }
}
