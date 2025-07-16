<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storages = [
            'Sklad Bratislava',
            'Sklad Trnava',
            'Sklad Nitra',
            'Sklad Košice',
        ];

        foreach ($storages as $name) {
            Storage::create(['name' => $name]);
        }
    }
}
