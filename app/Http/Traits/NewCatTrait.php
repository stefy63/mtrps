<?php

namespace App\Http\Traits;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarEmploymentCode;
use App\Models\CarOwner;
use App\Models\CarPower;
use App\Models\CarType;

trait NewCatTrait
{
    use Utils;

    private array $conversion = [
        "Proprieta" => 'name',
        "EnteAssegnatario" => 'ente',
        "Sezione" => 'name',
        "CasaCostruttrice" => 'name',
        "Modello" => 'name',
        "CodiceImpiego" => 'code',
        "Alimentazione" => 'name',
        "Colore" => 'color',
        "Pntermici" => 'winter_wheels',
        "TipologiaDiMezzo" => 'car_typology',
        "Conto" => 'profit_account',
        "CodicePanFuelCardQ8" => null,
        "CodicePanFuelCardIp" => null,
//        "INIZIORicoveroDal" => null,
//        "DisattivTetra" => null,
        "Ente" => null,
        "Serb" => 'tank',
        "ModelloPneumatici" => 'wheels_type',
//        "Termiche" => null,
        "Telaio" => 'chassis',
        "DataRevisione" => 'date_revision',
    ];

    private function newCar(array $data): Car
    {
        $car = new Car();
        if (!empty($data['CasaCostruttrice']) && $fieldName = $this->conversion['CasaCostruttrice']) {
            $car->carBrand()->associate($this->firstOrCreate(new CarBrand(), $fieldName, $data['CasaCostruttrice']));
        }
        if (!empty($data['Modello']) && $fieldName = $this->conversion['Modello']) {
            $car->carType()->associate($this->firstOrCreate(new CarType(), $fieldName, $data['Modello']));
        }
        if (!empty($data['Alimentazione']) && $fieldName = $this->conversion['Alimentazione']) {
            $car->carPower()->associate($this->firstOrCreate(new CarPower(), $fieldName, $data['Alimentazione']));
        }
        if (!empty($data['CodiceImpiego']) && $fieldName = $this->conversion['CodiceImpiego']) {
            $code = mb_substr($data['CodiceImpiego'], 0, 2);
            $description = mb_substr($data['CodiceImpiego'], 6);
            $extraField = [
                $fieldName => $code,
                'description' => $description,
                'extended' => $data['CodiceImpiego']
            ];
            $car->carEmployment()->associate($this->firstOrCreate(new CarEmploymentCode(), $fieldName, $code,
                $extraField));
        }
        if (!empty($data['Proprieta']) && $fieldName = $this->conversion['Proprieta']) {
            $car->carOwner()->associate($this->firstOrCreate(new CarOwner(), $fieldName, $data['Proprieta']));
        }
        $this->getConversion($car, 'Colore', $data);
//        $this->getConversion($car, 'Pntermici', $data, true);
        $this->getConversion($car, 'TipologiaDiMezzo', $data);
//        $this->getConversion($car, 'Note', $data);
//        $this->getConversion($car, 'Serb', $data);
//        $this->getConversion($car, 'ModelloPneumatici', $data);
        $this->getConversion($car, 'Telaio', $data);
        $this->getConversion($car, 'Conto', $data);
//        $data['DataRevisione'] = new \Carbon\Carbon($data['DataRevisione']);
//        $this->getConversion($car, 'DataRevisione', $data);
        $car['note'] = "Ente: {$data['Ente']}\nCODICE PAN Fuel Card IP: {$data['CodicePanFuelCardIp']}\nCODICE PAN Fuel Card Q8: {$data['CodicePanFuelCardQ8']}";


        $car->save();
        return $car;
    }

    public function getConversion(Car &$car, string $k, array $data, bool $bool = false): void
    {
        if (!empty($data[$k]) && $fieldName = $this->conversion[$k]) {
            $car[$fieldName] = $bool ? !empty($data[$k]) : $data[$k];
        }
    }


}