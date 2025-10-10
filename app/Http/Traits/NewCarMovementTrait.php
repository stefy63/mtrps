<?php

namespace App\Http\Traits;

use App\Models\Car;
use App\Models\Maintenance;
use App\Models\MaintenanceGarage;
use App\Models\MaintenanceType;
use App\Models\Movement;
use App\Models\Office;
use Carbon\Carbon;

trait NewCarMovementTrait
{
    use Utils;

    public function insertMovement(Car $car, array $data)
    {
        if (!empty($data['AutorimVtirrenoDal'])) {
            $office = Office::where('ente', 'AUTORIMESSA VIA TIRRENO')->first();
            $movement = Movement::create([
                'date_from' => Carbon::createFromFormat('d/m/Y', $data['AutorimVtirrenoDal']),
                'note' => $data['AutorimVtirreno-Motivazione'] ?? null
            ]);
            $movement->office()->associate($office);
            $car->movements()->save($movement);
        }

        if (!empty($data['DittaEsternaDal'])) {
            $garage = MaintenanceGarage::where('name', $data['DittaEsterna-Nome'])->first();
            $maintenceType = MaintenanceType::where('name', $data['DittaEsternaTipologia'])->first();
            $maintence = Maintenance::create([
                'date_from' => Carbon::createFromFormat('d/m/Y', $data['DittaEsternaDal']),
                'date_to' => Carbon::createFromFormat('d/m/Y', $data['FINERicoveroDal']),
            ]);
            $maintence->maintenanceTypes()->associate($maintenceType);
            $maintence->maintenanceGarages()->associate($garage);
            $car->maintenances()->save($maintence);
        }

    }
}