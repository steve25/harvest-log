<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fields = [
            ['name' => 'Pole A', 'hectares' => 12.5],
            ['name' => 'Pole B', 'hectares' => 8.0],
            ['name' => 'Pole C', 'hectares' => 15.3],
        ];

        foreach ($fields as $field) {
            Field::create($field);
        }
    }
}
