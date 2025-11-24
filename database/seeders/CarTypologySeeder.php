<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarTypologySeeder extends Seeder
{

    public function run(): void
    {
        $items = [
            'Auto Blindata',
            'Auto Civili',
            'Auto Istituto',
            'Mezzi Speciali Blindati',
            'Mezzo Speciale',
            'Moto Civili',
            'Moto Istituto',
            'Trasp. Person. 35 post. Civile',
            'Trasp. Person. 35 post. Istit.',
            'Trasp. Person. 9 post. Civile',
            'Trasp. Person. 9 post. Istit.',
            'Trasp. Person. Tutela Leggera',
            'Trasporto Materiale Civile',
            'Tutela Leggera Civile',
            'Tutela Leggera',
            'Tutela Pesante',
        ];

        foreach ($items as $item) {
            DB::table('car_typologies')->insert([
                'name' => $item,
            ]);
        }
    }
}
