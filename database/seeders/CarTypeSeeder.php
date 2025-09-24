<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarType;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carTypes = [
            [
                'name' => 'Autovettura',
                'description' => 'Autovettura a 4 porte',
                'note' => ''
            ],
            [
                'name' => 'Moto',
                'description' => 'Motocicletta a 2 ruote',
                'note' => ''
            ],
            [
                'name' => 'Blindata',
                'description' => 'Autovettura blindata',
                'note' => ''
            ],
        ];

        foreach ($carTypes as $carType) {
            CarType::create($carType);
        }
    }
}

// Per eseguire il seeder:
// php artisan db:seed --class=CarTypeSeeder