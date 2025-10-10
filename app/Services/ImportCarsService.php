<?php

namespace App\Services;

use App\Http\Traits\NewCarMovementTrait;
use App\Http\Traits\NewCarPlateTrait;
use App\Http\Traits\NewCatTrait;
use App\Models\Equipment;
use App\Models\Office;

class ImportCarsService
{
    use NewCatTrait;
    use NewCarPlateTrait;
    use NewCarMovementTrait;

    private $carModelField = [
        "Ricoveri" => null,
        "InCessioneTemporaneaDal" => null,
        "Colore" => null,
        "Pntermici" => null,
        "TipologiaDiMezzo" => null,
        "OP" => null,
        "INIZIORicoveroDal" => null,
        "DisattivTetra" => null,
        "Note" => null,
        "Serb" => null,
        "ModelloPneumatici" => null,
        "Termiche" => null,
        "NTelaio" => null,
        "DataRevisione" => null,
    ];


    private array $carPower = [
        "Alimentazione" => null,
    ];


    private array $proterty = [
        "Proprieta" => null,
    ];

    private array $movement = [
        "AutorimVtirrenoDal" => null,
        "AutorimVtirreno-Motivazione" => null,
        "DittaEsternaDal" => null,
        "DittaEsterna-Nome" => null,
        "DittaEsternaTipologia" => null,
        "FINERicoveroDal" => null,
    ];

    private array $carEquipment = [
        "Tetra" => null,
        "Telepass" => null,
    ];

    private array $carPLatesField = [
        "TgPol" => null,
        "TgCivile" => null,
        "TgOriginale" => null,
    ];

    private array $officeModelField = [
        "EnteAssegnatario" => null,
        "Sezione" => null,
    ];

    public function insert(array $data)
    {
        $car = $this->newCar($data);

        if (!empty($data['EnteAssegnatario']) && $fieldName = $this->conversion['EnteAssegnatario']) {
            $section = $this->conversion['Sezione'] ?? '';
            $office = Office::where($fieldName, $data['EnteAssegnatario'])
                ->where($section, $data['Sezione'])->first();
            $car->carOffices()->attach($office->id, ['date_from' => now()]);
        }

        if (!empty($data['Tetra']) && $equipement = Equipment::where('name', 'Radio TETRA')->first()) {
            $car->carEquipment()->attach($equipement->id, ['date_from' => now()]);
        }
        if (!empty($data['Telepass']) && $equipement = Equipment::where('name', 'Telepass')->first()) {
            $car->carEquipment()->attach($equipement->id, ['date_from' => now()]);
        }

        $this->insertPlate($car, $data);
        $this->insertMovement($car, $data);

    }


}