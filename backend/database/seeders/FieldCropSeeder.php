<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Crop;
use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FieldCropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset tabuľky
        // DB::table('field_crops')->truncate();

        // Predpoklad: už sú osiaté všetky polia a plodiny
        $fieldA = Field::where('name', 'Pole A')->first();
        $fieldB = Field::where('name', 'Pole B')->first();
        $fieldC = Field::where('name', 'Pole C')->first();

        $wheat = Crop::where('name', 'Pšenica')->first();
        $barley = Crop::where('name', 'Jačmeň')->first();
        $corn = Crop::where('name', 'Kukurica')->first();

        $fieldA->crops()->attach($wheat->id, ['hectares' => 7.0]);
        $fieldA->crops()->attach($barley->id, ['hectares' => 5.5]);

        $fieldB->crops()->attach($corn->id, ['hectares' => 8.0]);

        $fieldC->crops()->attach($wheat->id, ['hectares' => 15.3]);
    }
}
