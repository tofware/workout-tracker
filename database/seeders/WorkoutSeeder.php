<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = WorkoutCategory::all();

        for ($i = 0; $i < 5; $i++) {
            Workout::create([
                'name' => fake()->name,
                'workout_category_id' => $categories->random()->id,
                'user_id' => User::first()->id,
            ]);
        }
    }
}
