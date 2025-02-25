<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\User;
use App\Models\Workout;
use App\Models\Exercise;
use App\Enums\GoalStatus;
use App\Models\ExerciseSet;
use App\Models\ProgressMetric;
use App\Models\WorkoutSession;
use App\Models\ExerciseHistory;
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
            ->create([
                'email' => 'test@test.com',
                'password' => 'test'
            ]);

        $this->call([
            JsonSeeder::class,
            WorkoutCategorySeeder::class,
            WorkoutSeeder::class
        ]);

        $workouts = Workout::all();
        $exercises = Exercise::all();

        $workouts->each(function ($workout) use ($exercises, $user) {
            $selectedExercises = $exercises->random(rand(3, 5));

            $workoutSession = WorkoutSession::create([
                'user_id' => $user->id,
                'workout_id' => $workout->id,
                'notes' => fake()->text(30),
                'duration' => fake()->numberBetween(10, 200),
                'calories_burned' => fake()->numberBetween(10, 500),
                'average_intensity' => fake()->numberBetween(10, 500),
            ]);

            foreach ($selectedExercises as $index => $exercise) {
                WorkoutExercise::create([
                    'workout_id' => $workout->id,
                    'exercise_id' => $exercise->id,
                    'order' => $index + 1,
                ]);

                ExerciseSet::create([
                    'workout_session_id' => $workoutSession->id,
                    'exercise_id' => $exercise->id,
                    'set_number' => fake()->numberBetween(1, 5),
                    'repetitions' => fake()->numberBetween(1, 50),
                    'weight' => fake()->numberBetween(1, 500),
                    'notes' => fake()->text(30),
                ]);

                ExerciseHistory::create([
                    'user_id' => $user->id,
                    'exercise_id' => $exercise->id,
                    'date' => fake()->date,
                    'best_weight' => fake()->numberBetween(1, 1000),
                    'best_repetitions' => fake()->numberBetween(1, 50),
                    'one_rep_max' => fake()->numberBetween(1, 1000),
                    'notes' => fake()->text(50)
                ]);

                Goal::create([
                    'user_id' => $user->id,
                    'exercise_id' => $exercise->id,
                    'goal_type' => fake()->text(10),
                    'target_value' => fake()->numberBetween(1, 100),
                    'deadline' => fake()->date,
                    'status' => fake()->randomElement(array_keys(GoalStatus::cases())),
                    'notes' => fake()->text(30)
                ]);
            }
        });

        ProgressMetric::create([
            'user_id' => $user->id,
            'weight' => fake()->numberBetween(10, 200),
            'body_fat_percentage' => fake()->numberBetween(1, 100),
            'muscle_mass' => fake()->numberBetween(1, 100),
            'notes' => fake()->text(30),
        ]);
    }
}
