<?php

namespace Database\Seeders;

use App\Models\ExerciseSet;
use Illuminate\Database\Seeder;

class ExerciseSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExerciseSet::factory()->create(5);
    }
}
