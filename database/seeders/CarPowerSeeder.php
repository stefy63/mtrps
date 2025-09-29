<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarPowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $power = [
            'Benzina',
            'Diesel',
            'Elettrica',
            'Ibrida',
            'Metano',
            'GPL',
            'Elettrica a Batteria',
            'Elettrica a Celle a Combustibile',
            'Idrogeno',
            'Altri',
        ];

        foreach ($power as $p) {
            \App\Models\CarPower::create(['name' => $p]);
        }
    }
}
