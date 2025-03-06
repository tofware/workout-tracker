<?php

namespace Database\Factories;

use App\Enums\GoalStatus;
use App\Models\Exercise;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Goal>
 */
class GoalFactory extends Factory
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
            'goal_type' => fake()->text(10),
            'target_value' => fake()->numberBetween(1, 100),
            'deadline' => fake()->date,
            'status' => fake()->randomElement(array_keys(GoalStatus::cases())),
            'notes' => fake()->text(30),
        ];
    }
}
