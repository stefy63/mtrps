<?php

namespace App\Http\Traits;

use App\Models\Car;
use App\Models\Equipment;

trait NewCarEquipment
{

    use Utils;

    private array $carAssociateField = [
        "Tetra" => ['name', 'Radio TETRA', 'Issi'],
        "Telepass" => ['name', 'Telepass', 'TelepassSeriale'],
        "CodicePanFuelCardIp" => ['name', 'Fuel Card IP', 'CodicePanFuelCardIp'],
        "CodicePanFuelCardQ8" => ['name', 'Fuel Card Q8', 'CodicePanFuelCardQ8'],
    ];

    public function  associateEquipment(Car $car, array $data)
    {
        foreach( $this->carAssociateField as $k => $equipment) {
            if (!empty($data[$k]) && $eq = Equipment::where($equipment[0], $equipment[1])->first()) {
                $car->carEquipment()->attach($eq, ['date_from' => now(), 'note' => $data[$equipment[2]]]);
            }
        }
    }
}
