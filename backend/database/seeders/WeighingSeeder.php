<?php

namespace Database\Seeders;

use App\Models\FieldCrop;
use App\Models\Vehicle;
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
        $vehicles = Vehicle::pluck('id')->toArray();
        $fieldCrops = FieldCrop::pluck('id')->toArray();

        $faker = \Faker\Factory::create('sk_SK');

        for ($i = 0; $i < 20; $i++) {
            $tara = $faker->randomFloat(2, 3000, 5000);
            $brutto = $faker->randomFloat(2, $tara + 3000, $tara + 8000);
            $netto = $brutto - $tara;

            Weighing::create([
                'vehicle_id' => $faker->randomElement($vehicles),
                'field_crop_id' => $faker->randomElement($fieldCrops),
                'brutto_kg' => $brutto,
                'netto_kg' => $netto,
                'tara_kg' => $tara,
                'recorded_at' => Carbon::now()->subDays(rand(0, 7))->setTime(rand(6, 19), rand(0, 59))
            ]);
        }
    }
}
