<?php

namespace App\Http\Traits;

use App\Models\Car;
use App\Models\Plate;

trait NewCarPlateTrait
{
    use Utils;

    private array $carPlatesField = [
        "TgPol" => ['name', 'POLIZIA'],
        "TgCivile" => ['name', 'CIVILE'],
        "TgOriginale" => ['name', 'ORIGINALE'],
    ];

    public function  insertPlate(Car $car, array $data)
    {
        foreach( $this->carPlatesField as $k => $plate) {
            if (!empty($data[$k])) {
                $data[$k] = str_replace('*', ' ', $data[$k]);
                $tg = $this->firstOrCreate(new Plate(), $plate[0], $data[$k], [
                    'type' => $plate[1]
                ]);
                $car->carPlates()->attach($tg->id, ['date_from' => now()]);
            }
        }


    }
}