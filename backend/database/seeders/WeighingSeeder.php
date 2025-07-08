<?php

namespace Database\Seeders;

use App\Models\Weighing;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeighingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weighings = [
            [
                'vehicle_id' => 1,
                'field_crop_id' => 1,
                'brutto_kg' => 12500.75,
                'netto_kg' => 8320.50,
                'tara_kg' => 4180.25,
                'recorded_at' => Carbon::parse('2025-07-08 14:30:00'),
            ],
            [
                'vehicle_id' => 2,
                'field_crop_id' => 2,
                'brutto_kg' => 14000.00,
                'netto_kg' => 9200.00,
                'tara_kg' => 4800.00,
                'recorded_at' => Carbon::parse('2025-07-08 15:45:00'),
            ],
            [
                'vehicle_id' => 3,
                'field_crop_id' => 1,
                'brutto_kg' => 11780.25,
                'netto_kg' => 7980.25,
                'tara_kg' => 3800.00,
                'recorded_at' => Carbon::parse('2025-07-08 17:05:00'),
            ],
        ];

        foreach ($weighings as $data) {
            Weighing::create($data);
        }
    }
}
