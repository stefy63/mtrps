<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarPlate;
use App\Models\Equipment;
use http\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarsService
{

    /**
     * @param  Car  $car
     * @param  int  $officeId
     * @param  string  $dateToAssignee
     * @return Car
     * @throws \Throwable
     */
    public function setOfficeAssignee(Car $car, int $officeId, string $dateToAssignee)
    {
        $office = \App\Facades\OfficesService::getOfficeById($officeId);
        throw_if(!$office, NotFoundHttpException::class);

        $oldOffice = $car->carOffices()->wherePivotNull('date_to')->first();
        if ($officeId && $officeId !== $oldOffice->id) {
            $car->carOffices()->wherePivotNull('date_to')->updateExistingPivot($oldOffice->id, [
                'date_to' => $dateToAssignee
            ]);
            $car->carOffices()->attach($officeId, [
                'date_from' => $dateToAssignee
            ]);
        }
        return $car;
    }

    public function setCarPLate(Car $car, ?int $plateId = null, ?bool $force = false)
    {
        if (isset($plateId)) {
            $plate = CarPlate::with('car')->find($plateId);
            throw_if(
                $plate->car_id !== $car->id && $plate->whereNull('date_to') && !$force,
                \Exception::class,
                "La targa $plate->name è assegnata alla vettura ".$plate->car->full_name
            );
            if ($plate->car_id !== $car->id) {
                $plate->date_to = now();
                $plate->save();
                $plate->id = null;
                $plate->date_to = null;
                $plate->date_from = now();
                $car->carPlates()->create($plate->toArray());
            }
        }
        return $car;
    }

    public function setCarEquipments(Car $car, array $equipments)
    {
        if (count($equipments) > 0) {
            $car->carEquipment()->detach();
            foreach ($equipments as $key => $eq) {
                if ((int)$eq['attivo'] === 1 && $equipement = Equipment::whereId($key)->first()) {
                    $car->carEquipment()->attach($key,
                        ['date_from' => now(), 'note' => $eq['note'] ?? '']);
                }
            };
        }
        return $car;
    }
}
