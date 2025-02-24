<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            'Dumbbells',
            'Barbell',
            'Kettlebell',
            'Resistance Bands',
            'EZ Curl Bar',
            'Smith Machine',
            'Trap Bar',
            'Medicine Ball',
            'Sandbag',
            'Battle Ropes',
            'Jump Rope',
            'Weight Plates',
            'Cable Machine',
            'Lat Pulldown Machine',
            'Leg Press Machine',
            'Leg Curl Machine',
            'Leg Extension Machine',
            'Chest Press Machine',
            'Rowing Machine',
            'Treadmill',
            'Exercise Bike',
            'Elliptical Trainer',
            'Stair Climber',
            'Pull-Up Bar',
            'Dip Bars',
            'Parallettes',
            'Gymnastic Rings',
            'Ab Roller',
            'Sliders',
            'Plyo Box',
            'Bosu Ball',
            'TRX Suspension Trainer',
            'Smith Machine',
            'Foam Roller',
            'Weighted Vest',
            'Sled',
            'Landmine Attachment',
            'Hack Squat Machine',
            'Glute Ham Developer (GHD)',
            'Back Extension Machine',
        ];

        foreach ($equipments as $equipment) {
            Equipment::create([
                'name' => $equipment,
            ]);
        }
    }
}
