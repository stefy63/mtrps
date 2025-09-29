<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = __DIR__.'/excel/ELENCO_PROPIETARI.csv';
        $file_handle = fopen($csvFile, 'r');
        while ($csvRow = fgetcsv($file_handle, null, ';')) {
            \DB::table('car_owners')->insert([
                'name' => $csvRow[0] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        fclose($file_handle);
    }
}
