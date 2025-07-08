<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Traktor 1 - Jano',
                'plate_number' => 'BA123XY',
                'last_tara_kg' => 4200.50,
            ],
            [
                'name' => 'Nákladné auto - Fero',
                'plate_number' => 'KE456ZZ',
                'last_tara_kg' => 7380.00,
            ],
            [
                'name' => 'Traktor 2 - Robo',
                'plate_number' => 'TN789AB',
                'last_tara_kg' => 3950.75,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create([
                'name' => $vehicle['name'],
                'plate_number' => $vehicle['plate_number'],
                'last_tara_kg' => $vehicle['last_tara_kg'],
            ]);
        }
    }
}
