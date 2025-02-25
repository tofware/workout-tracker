<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Instruction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instruction>
 */
class InstructionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exercise_id' => Exercise::factory(),
            'instruction' => fake()->text(25),
        ];
    }
}
