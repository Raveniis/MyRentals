<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(6, 10),
            'application_id' => fake()->numberBetween(1, 10),
            'emergency_num' => fake()->phoneNumber(),
            'remarks' => fake()->sentence(3, true),
        ];
    }
}
