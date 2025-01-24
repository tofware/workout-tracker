<?php

namespace Database\Seeders;

use App\Models\WorkoutSession;
use Illuminate\Database\Seeder;

class WorkoutSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkoutSession::factory(5)->create();
    }
}
