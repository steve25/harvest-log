<?php

namespace Database\Seeders;

use App\Models\Crop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crops = ['Pšenica', 'Jačmeň', 'Kukurica', 'Repka', 'Hrach'];

        foreach ($crops as $crop) {
            Crop::create(['name' => $crop]);
        }
    }
}
