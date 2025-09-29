<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = __DIR__.'/excel/ELENCO_COSTRUTTORI.csv';
        $file_handle = fopen($csvFile, 'r');
        while ($csvRow = fgetcsv($file_handle, null, ';')) {
            \DB::table('car_brands')->insert([
                'name' => $csvRow[0] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        fclose($file_handle);
    }
}

// Per eseguire il seeder:
// php artisan db:seed --class=CarBrandSeeder
