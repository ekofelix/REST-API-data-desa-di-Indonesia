<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use League\Csv\Reader;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        // Path ke file CSV
        $path = base_path('data/districts.csv');

        // Buat reader CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // Menggunakan baris pertama sebagai header

        // Membaca data CSV dan memasukkan ke database
        foreach ($csv as $record) {
            District::create([
                'id' => $record['id'],
                'regency_id' => $record['regency_id'],
                'name' => $record['name'],
            ]);
        }
    }
}
