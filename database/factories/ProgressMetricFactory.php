<?php

namespace Database\Factories;

use App\Models\ProgressMetric;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgressMetric>
 */
class ProgressMetricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'weight' => fake()->numberBetween(10, 100),
            'body_fat_percentage' => fake()->numberBetween(1, 100),
            'muscle_mass' => fake()->numberBetween(1, 100),
            'notes' => fake()->text(30),
        ];
    }
}
