<?php

namespace App\Services;

use App\Enum\PlateTypeEnum;
use App\Models\Car;
use App\Models\CarPlate;
use App\Models\Equipment;
use App\Models\Plate;
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
    public function setOfficeAssignee(Car $car, int $officeId, ?string $dateToAssignee)
    {
        $office = \App\Facades\OfficesService::getOfficeById($officeId);
        throw_if(!$office, NotFoundHttpException::class);

        $oldOffice = $car->carOffices()->wherePivotNull('date_to')->first();
        if ($oldOffice && $officeId !== $oldOffice->id) {
            $car->carOffices()->wherePivotNull('date_to')->updateExistingPivot($oldOffice->id, [
                'date_to' => $dateToAssignee ?? now()
            ]);
        }
        $car->carOffices()->attach($officeId, [
            'date_from' => $dateToAssignee ?? now()
        ]);
        return $car;
    }

    public function setCarPLate(Car $car, ?int $plateId = null, PlateTypeEnum $type, ?bool $force = false)
    {
        if (isset($plateId)) {
            $plate = Plate::with('cars')->whereType($type)->find($plateId);
            $oldCar = $plate->cars()->wherePivotNull('date_to')->first();
            throw_if(
                $oldCar && $oldCar->pivot->car_id !== $car->id && !$force,
                \Exception::class,
                "La targa $plate->name è assegnata alla vettura ".$oldCar?->full_name ?? ''
            );
            if ($oldCar && $oldCar->id !== $car->id) {
                \App\Facades\PlateService::dissociateCar($oldCar, $plate);
                \App\Facades\PlateService::associateCar($car, $plate);
            } elseif (!$oldCar) {
                \App\Facades\PlateService::associateCar($car, $plate);
            }
        } else {
            if ($oldPlate = $car->carPlates()->wherePivotNull('date_to')->whereType($type)->first()) {
                \App\Facades\PlateService::dissociateCar($car, $oldPlate);
            }
        }
        return $car;
    }

    public function setCarEquipments(Car $car, array $equipments)
    {
        if (count($equipments) > 0) {
            $car->carEquipment()->detach();
            foreach ($equipments as $key => $eq) {
                if ((int) $eq['attivo'] === 1 && Equipment::whereId($key)->exists()) {
                    $car->carEquipment()->attach($key,
                        ['date_from' => now(), 'note' => $eq['note'] ?? '']);
                }
            };
        }
        return $car;
    }
}
