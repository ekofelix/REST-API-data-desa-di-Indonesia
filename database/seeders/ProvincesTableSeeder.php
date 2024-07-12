<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use League\Csv\Reader;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        // Path ke file CSV
        $path = base_path('data/provinces.csv');

        // Buat reader CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Menggunakan baris pertama sebagai header

        // Membaca data CSV dan memasukkan ke database
        foreach ($csv as $record) {
            Province::create([
                'id' => $record['id'],
                'name' => $record['name'],
            ]);
        }
    }
}
