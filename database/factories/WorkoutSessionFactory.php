<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkoutSession>
 */
class WorkoutSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workout_id' => Workout::factory()->create(),
            'user_id' => User::factory()->create(),
            'notes' => fake()->text(30),
            'duration' => fake()->numberBetween(10, 200),
            'calories_burned' => fake()->numberBetween(10, 500),
            'average_intensity' => fake()->numberBetween(10, 500),
        ];
    }
}
