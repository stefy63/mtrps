<?php

namespace App\Services;

use App\Models\Car;

class ImportKmService
{

    public function insert(array $data)
    {
        if($car = Car::when($data['Km'] > 0)->with(['carPlates'])->whereHas('carPlates', function ($q) use ($data) {
            $q->where('name', 'like', "%{$data['Targa']}%")
                ->where('type', '=', "POLIZIA");
        })->first()) {
            return $car->update(['km' => $data['Km']]);
        } else {
            return false;
        }
    }
}
