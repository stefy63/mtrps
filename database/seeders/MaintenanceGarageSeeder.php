<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceGarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = __DIR__.'/excel/ELENCO_DITTE.csv';
        $file_handle = fopen($csvFile, 'r');
        while ($csvRow = fgetcsv($file_handle, null, ';')) {
            \DB::table('maintenance_garages')->insert([
                'name' => $csvRow[0] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        fclose($file_handle);
    }
}
