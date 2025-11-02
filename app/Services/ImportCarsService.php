<?php

namespace App\Services;

use App\Http\Traits\NewCarMovementTrait;
use App\Http\Traits\NewCarPlateTrait;
use App\Http\Traits\NewCatTrait;
use \App\Facades\OfficesService;
use App\Models\Equipment;


class ImportCarsService
{
    use NewCatTrait;
    use NewCarPlateTrait;
    use NewCarMovementTrait;

    public function insert(array $data)
    {
        $car = $this->newCar($data);
        if (!empty($data['EnteAssegnatario'])) {
            $office = OfficesService::getOfficeByName($data['EnteAssegnatario'],
                $data['Sezione'] ?? null);
            $car->carOffices()->attach($office->id, ['date_from' => now()]);
        }

        if (!empty($data['Tetra']) && $equipement = Equipment::where('name', 'Radio TETRA')->first()) {
            $car->carEquipment()->attach($equipement->id, ['date_from' => now(), 'note' => $data['Issi'] ?? '']);
        }
        if (!empty($data['Telepass']) && $equipement = Equipment::where('name', 'Telepass')->first()) {
            $car->carEquipment()->attach($equipement->id,
                ['date_from' => now(), 'note' => $data['TelepassSeriale'] ?? '']);
        }
        if (!empty($data['CodicePanFuelCardIp']) && $equipement = Equipment::where('name', 'Fuel Card IP')->first()) {
            $car->carEquipment()->attach($equipement->id,
                ['date_from' => now(), 'note' => $data['CodicePanFuelCardIp'] ?? '']);
        }
        if (!empty($data['CodicePanFuelCardQ8']) && $equipement = Equipment::where('name', 'Fuel Card Q8')->first()) {
            $car->carEquipment()->attach($equipement->id,
                ['date_from' => now(), 'note' => $data['CodicePanFuelCardQ8'] ?? '']);
        }

        $this->insertPlate($car, $data);
        $this->insertMovement($car, $data);
    }


}