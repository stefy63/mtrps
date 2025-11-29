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
        // if ($data['car_id'] !== $movement->car_id) {
            throw_if(
                $this->isBusyCar($data, $movement) || $this->isAfterLastFreeCar($data, $movement),
                'Vettura già impegnata.'
            );
        // }

        $movement->update($data);
    }

    public function create(array $data)
    {
        throw_if(
            $this->isBusyCar($data) || $this->isAfterLastFreeCar($data),
            'Vettura già impegnata.'
        );
        return Movement::create($data);
    }


    /**
     * @param  array  $data
     * @return bool
     */
    private function isBusyCar(array $data, ?Movement $movement = null): bool
    {
        return Movement::where('car_id', $data['car_id'])
            ->when($movement?->id, fn($q) => $q->where('id', '!=', $movement->id))
            ->whereNull('date_to')
            ->exists();
    }

    /**
     * @param  array  $data
     * @return bool
     */
    private function isAfterLastFreeCar(array $data, ?Movement $movement = null): bool
    {
        return Movement::where('car_id', $data['car_id'])
            ->when($movement?->id, fn($q) => $q->where('id', '!=', $movement->id))
            ->where('date_to', '>', $data['date_from'])
            ->exists();
    }

}
