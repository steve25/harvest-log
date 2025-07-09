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
        $fieldA = Field::firstOrCreate(['name' => 'Pole A'], ['hectares' => 15.0]);
        $fieldB = Field::firstOrCreate(['name' => 'Pole B'], ['hectares' => 12.0]);
        $fieldC = Field::firstOrCreate(['name' => 'Pole C'], ['hectares' => 20.0]);

        $crops = Crop::pluck('id', 'name'); // ['Pšenica' => 1, ...]

        // Pole A: Pšenica + Jačmeň
        $fieldA->crops()->attach($crops['Pšenica'], ['hectares' => 7.0]);
        $fieldA->crops()->attach($crops['Jačmeň'], ['hectares' => 5.5]);

        // Pole B: Kukurica + Hrach
        $fieldB->crops()->attach($crops['Kukurica'], ['hectares' => 6.0]);
        $fieldB->crops()->attach($crops['Hrach'], ['hectares' => 3.5]);

        // Pole C: Repka + Jačmeň + Pšenica
        $fieldC->crops()->attach($crops['Repka'], ['hectares' => 8.0]);
        $fieldC->crops()->attach($crops['Jačmeň'], ['hectares' => 5.0]);
        $fieldC->crops()->attach($crops['Pšenica'], ['hectares' => 7.3]);
    }
}
