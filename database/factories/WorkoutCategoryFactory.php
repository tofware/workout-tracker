<?php

namespace Database\Factories;

use App\Models\WorkoutCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkoutCategory>
 */
class WorkoutCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name
        ];
    }
}
