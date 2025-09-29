<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarEmploymentCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = __DIR__.'/excel/CODICI_IMPIEGO.csv';
        $file_handle = fopen($csvFile, 'r');
        while ($csvRow = fgetcsv($file_handle, null, ';')) {
            \DB::table('car_employment_codes')->insert([
                'code' => $csvRow[1] ?? '',
                'description' => $csvRow[2] ?? '',
                'extended' => $csvRow[0] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        fclose($file_handle);
    }
}
