<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Regency;
use League\Csv\Reader;

class RegenciesTableSeeder extends Seeder
{
    public function run()
    {
        // Path ke file CSV
        $path = base_path('data/regencies.csv');

        // Buat reader CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Menggunakan baris pertama sebagai header

        // Membaca data CSV dan memasukkan ke database
        foreach ($csv as $record) {
            Regency::create([
                'id' => $record['id'],
                'province_id' => $record['province_id'],
                'name' => $record['name'],
            ]);
        }
    }
}
