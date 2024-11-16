<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\MuscleGroup;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->hasWorkouts(3)
            ->create([
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        Equipment::factory(3)->create();
        MuscleGroup::factory(10)->create();
    }
}
