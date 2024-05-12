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
            'tenant_id' => fake()->numberBetween(6, 10),
            'rental_id' => fake()->numberBetween(1, 10),
            'occupants_number' => fake()->numberBetween(2, 8),
            'move_in_date' => fake()->dateTimeBetween('now', '+1 year'),
            'lease_term' => fake()->numberBetween(4, 18),
            'monthly_income' => fake()->randomFloat(2, 12000, 50000),
            'emergency_num' => fake()->phoneNumber(),
            'employment_status' => fake()->randomElement(['employed', 'unemployed']),   //assumes that all tenant applicants have a job
            'application_status' => 'pending',  //all applicants status is pending
        ];
    }
}
