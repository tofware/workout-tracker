<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscleGroups = MuscleGroup::all();
        $equipments = Equipment::all();

        for ($i = 0; $i < 20; $i++) {
            Exercise::create([
                'name' => fake()->name,
                'difficulty' => fake()->firstName,
                'instructions' => fake()->rgbColorAsArray,
                'muscle_group_id' => $muscleGroups->random()->id,
                'equipment_id' => $equipments->random()->id,
            ]);
        }
    }
}
