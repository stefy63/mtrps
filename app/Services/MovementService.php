<?php

namespace App\Services;

use App\Models\Movement;

class MovementService
{
    public function __construct()
    {
    }

    public function update(Movement $movement, array $data)
    {
        if ($data['car_id'] !== $movement->car_id) {
            throw_if(
                $this->isBusyCar($data['car_id']) || $this->isAfterLastFreeCar($data['car_id'], $data['date_from']),
                'Vettura già impegnata.'
            );
        }

        dd($movement->toArray(), $data);
        $movement->update($data);
    }

    public function create(array $data)
    {
        throw_if(
            $this->isBusyCar($data['car_id']) || $this->isAfterLastFreeCar($data['car_id'], $data['date_from']),
            'Vettura già impegnata.'
        );
        return Movement::create($data);
    }


    /**
     * @param  int  $carId
     * @return bool
     */
    private function isBusyCar(int $carId): bool
    {
        return Movement::where('car_id', $carId)
            ->whereNull('date_to')->exists();
    }

    /**
     * @param  int  $carId
     * @param  string  $date_from
     * @return bool
     */
    private function isAfterLastFreeCar(int $carId, string $date_from): bool
    {
        return Movement::where('car_id', $carId)
            ->whereDate('date_to', '>', $date_from)->exists();
    }

}
