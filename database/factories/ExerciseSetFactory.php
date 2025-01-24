<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\ExerciseSet;
use App\Models\WorkoutSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExerciseSet>
 */
class ExerciseSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workout_session_id' => WorkoutSession::factory()->create(),
            'exercise_id' => Exercise::factory()->create(),
            'set_number' => fake()->numberBetween(1, 5),
            'repetitions' => fake()->numberBetween(1, 50),
            'weight' => fake()->numberBetween(1, 500),
            'notes' => fake()->text(30),
            'rest_time' => fake()->numberBetween(1, 25),
        ];
    }
}
