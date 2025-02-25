<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\ExerciseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'difficulty' => fake()->firstName,
            'force' => fake()->name,
            'mechanic' => fake()->name,
            'equipment_id' => Equipment::factory(),
            'exercise_category_id' => ExerciseCategory::factory()
        ];
    }
}
