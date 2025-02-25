<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Equipment;
use App\Models\ExerciseCategory;
use App\Models\ExerciseMuscleGroup;
use App\Models\Instruction;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class JsonSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = storage_path('app/exercises.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found: $jsonPath");
            return;
        }

        $jsonData = File::get($jsonPath);
        $exercises = json_decode($jsonData, true);

        if (!$exercises) {
            $this->command->error("Invalid JSON format");
            return;
        }

        foreach ($exercises as $exerciseData) {
            if($exerciseData['equipment']){
                $equipment = Equipment::firstOrCreate(['name' => ucfirst($exerciseData['equipment'])]);
            }

            $category = ExerciseCategory::firstOrCreate(['name' => ucfirst($exerciseData['category'])]);

            $exercise = Exercise::updateOrCreate(
                [
                    'name' => $exerciseData['name']
                ],
                [
                    'force' => ucfirst($exerciseData['force']),
                    'mechanic' => ucfirst($exerciseData['mechanic']),
                    'difficulty' => ucfirst($exerciseData['level']),
                    'equipment_id' => $equipment->id ?? Equipment::where('name', 'Body only')->first()->id,
                    'exercise_category_id' => $category->id
                ]
            );

            foreach($exerciseData['instructions'] as $instruction) {
                Instruction::firstOrCreate([
                    'exercise_id' => $exercise->id,
                    'instruction' => $instruction
                ]);
            }

            foreach ($exerciseData['primaryMuscles'] as $muscleName) {
                $muscleGroup = MuscleGroup::firstOrCreate(['name' => ucfirst($muscleName)]);
                ExerciseMuscleGroup::create([
                    'exercise_id' => $exercise->id,
                    'muscle_group_id' => $muscleGroup->id,
                    'primary' => true
                ]);
            }

            foreach ($exerciseData['secondaryMuscles'] as $muscleName) {
                $muscleGroup = MuscleGroup::firstOrCreate(['name' => ucfirst($muscleName)]);
                ExerciseMuscleGroup::create([
                    'exercise_id' => $exercise->id,
                    'muscle_group_id' => $muscleGroup->id,
                    'primary' => false
                ]);
            }

        }
    }
}
