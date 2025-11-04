<?php

namespace App\Services;

use App\Http\Traits\NewCarEquipment;
use App\Http\Traits\NewCarMovementTrait;
use App\Http\Traits\NewCarPlateTrait;
use App\Http\Traits\NewCatTrait;
use \App\Facades\OfficesService;


class ImportCarsService
{
    use NewCatTrait;
    use NewCarPlateTrait;
    use NewCarMovementTrait;
    use NewCarEquipment;

    public function insert(array $data)
    {
        try {
            $car = $this->newCar($data);
            if (!empty($data['EnteAssegnatario'])) {
                $office = OfficesService::getOfficeByName($data['EnteAssegnatario'],
                    $data['Sezione'] ?? null);
                $car->carOffices()->attach($office->id, ['date_from' => now()]);
            }
            $this->associateEquipment($car, $data);
            $this->insertPlate($car, $data);
            $this->insertMovement($car, $data);
        } catch (\Throwable $e) {
            dd('------------', $car->toArray(), $data, $e->getMessage());
        }
    }


}