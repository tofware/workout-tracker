<?php

namespace Database\Seeders;

use App\Models\ProgressMetric;
use Illuminate\Database\Seeder;

class ProgressMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgressMetric::factory()->create(3);
    }
}
