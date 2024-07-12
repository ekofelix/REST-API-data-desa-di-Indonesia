<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Village;
use League\Csv\Reader;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        // Path ke file CSV
        $path = base_path('data/villages.csv');

        // Buat reader CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Menggunakan baris pertama sebagai header

        // Membaca data CSV dan memasukkan ke database
        foreach ($csv as $record) {
            Village::create([
                'id' => $record['id'],
                'district_id' => $record['district_id'],
                'name' => $record['name'],
            ]);
        }
    }
}
