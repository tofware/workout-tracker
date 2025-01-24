<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\MuscleGroup;
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
            'instructions' => fake()->rgbColorAsArray,
            'muscle_group_id' => MuscleGroup::factory(),
            'equipment_id' => Equipment::factory(),
        ];
    }
}
