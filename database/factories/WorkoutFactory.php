<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workout>
 */
class WorkoutFactory extends Factory
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
            'workout_category_id' => WorkoutCategory::factory(),
            'user_id' => User::factory(),
        ];
    }
}
