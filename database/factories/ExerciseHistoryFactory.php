<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\ExerciseHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExerciseHistory>
 */
class ExerciseHistoryFactory extends Factory
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
            'exercise_id' => Exercise::factory()->create(),
            'date' => fake()->date,
            'best_weight' => fake()->numberBetween(1, 1000),
            'best_repetitions' => fake()->numberBetween(1, 50),
            'one_rep_max' => fake()->numberBetween(1, 1000),
            'notes' => fake()->text(50)
        ];
    }
}
