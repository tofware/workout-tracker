<?php

namespace Database\Seeders;

use App\Models\ExerciseHistory;
use Illuminate\Database\Seeder;

class ExerciseHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExerciseHistory::factory()->create(5);
    }
}
