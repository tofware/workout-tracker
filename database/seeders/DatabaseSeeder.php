<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WorkoutExercise;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()
            ->hasWorkouts(3)
            ->create([
                'email' => 'test@test.com',
                'password' => 'password'
            ]);

        $exercises = Exercise::factory(10)->create();

        $user->workouts->each(function ($workout) use ($exercises) {
            $selectedExercises = $exercises->random(rand(3, 5));

            foreach ($selectedExercises as $index => $exercise) {
                WorkoutExercise::create([
                    'workout_id' => $workout->id,
                    'exercise_id' => $exercise->id,
                    'order' => $index + 1,
                ]);
            }
        });
    }
}
