<?php

namespace Database\Seeders;

use App\Models\WorkoutCategory;
use Illuminate\Database\Seeder;

class WorkoutCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Strength Training',
            'Hypertrophy (Muscle Growth)',
            'Endurance Training',
            'Powerlifting',
            'Bodyweight Training',
            'Cardio',
            'HIIT (High-Intensity Interval Training)',
            'Circuit Training',
            'Mobility & Flexibility',
            'Warm-up',
            'Cooldown',
            'Functional Fitness',
            'Athletic Performance',
            'Core Training',
            'Full Body',
            'Upper Body',
            'Lower Body',
            'Push Day',
            'Pull Day',
            'Leg Day',
        ];

        foreach ($categories as $category) {
            WorkoutCategory::create([
                'name' => $category,
            ]);
        }
    }
}
