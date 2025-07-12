<?php

namespace Database\Seeders;

use App\Models\FieldCrop;
use App\Models\Storage;
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
        $storages = Storage::pluck('id')->toArray();

        $faker = \Faker\Factory::create('sk_SK');

        for ($i = 0; $i < 20; $i++) {
            $tara = $faker->randomFloat(2, 3000, 5000);
            $brutto = $faker->randomFloat(2, $tara + 3000, $tara + 8000);
            $netto = $brutto - $tara;

            $bulkDensity = $faker->numberBetween(500, 900);
            $moisture = $faker->numberBetween(10, 30);

            $recordDate = Carbon::now()->subDays(rand(0, 7))->setTime(rand(6, 19), rand(0, 59));
            $startRecordDate = (clone $recordDate)->subMinutes(rand(5, 15));

            Weighing::create([
                'vehicle_id'        => $faker->randomElement($vehicles),
                'field_crop_id'     => $faker->randomElement($fieldCrops),
                'coming_weight_kg'  => $brutto,
                'leaving_weight_kg' => $netto,
                'netto_weight_kg'   => $tara,
                'bulk_density'      => $bulkDensity,
                'moisture'          => $moisture,
                'start_record_at'   => $startRecordDate,
                'recorded_at'       => $recordDate,
                'storage_id'        => $faker->randomElement($storages),
            ]);
        }
    }
}
