<?php

namespace Database\Seeders;

use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class MuscleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscleGroups = [
            'Chest',
            'Back',
            'Shoulders',
            'Biceps',
            'Triceps',
            'Forearms',
            'Quadriceps',
            'Hamstrings',
            'Glutes',
            'Calves',
            'Core (Abs & Obliques)',
            'Upper Chest',
            'Lower Chest',
            'Lats (Latissimus Dorsi)',
            'Traps (Trapezius)',
            'Rear Delts (Posterior Deltoid)',
            'Side Delts (Lateral Deltoid)',
            'Front Delts (Anterior Deltoid)',
            'Adductors (Inner Thighs)',
            'Abductors (Outer Thighs)',
            'Erector Spinae (Lower Back)',
            'Serratus Anterior',
        ];

        foreach ($muscleGroups as $muscleGroup) {
            MuscleGroup::create([
                'name' => $muscleGroup,
            ]);
        }
    }
}
