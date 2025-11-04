<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarPlate;
use App\Models\Plate;

class PlateService
{
    public function __construct()
    {
    }

    public function associateCar(Car $car, PLate $plate)
    {
        $plate->cars()->attach($car->id, ['date_from' => now()]);
//        $car->carPlates()->attach($plate->id, ['date_from' => now()]);
    }

    public function dissociateCar(Car $car, PLate $plate)
    {
        $plate->cars()->updateExistingPivot($car->id, ['date_to' => now()]);
        $plate->cars()->syncWithoutDetaching($car->id);

//        $car->carPlates()->updateExistingPivot($plate->id, ['date_to' => now()]);
//        $car->carPlates()->syncWithoutDetaching($plate->id);
    }

}
