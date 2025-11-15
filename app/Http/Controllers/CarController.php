<?php

namespace App\Http\Controllers;

use App\Enum\PlateTypeEnum;
use App\Facades\CarsService;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarEmploymentCode;
use App\Models\CarOwner;
use App\Models\CarPower;
use App\Models\CarProfitAccount;
use App\Models\CarType;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\Plate;
use App\Services\FilterCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Car::with([
            'carType',
            'carOwner',
            'carBrand',
            'carPower',
            'carProfitAccount',
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
            'carOffices' => fn($q) => $q->wherePivotNull('date_to'),
            'carEquipment' => fn($q) => $q->wherePivotNull('date_to'),
        ]);
        if ($unavailable = $request->exists('unavailable')) {
            $query->withoutGlobalScope('available');
        }
        // Filtri
        if ($search = $request->search) {
            $query = FilterCarService::getRelationWithFilter($query, $search);
        }

        confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");

        $cars = $query->paginate();
        return view('car.index', compact('cars', 'search','unavailable', 'carEquipmentById' ))
            ->with('i', ($request->input('page', 1) - 1) * $cars->perPage());
    }

    public function getForm(): View
    {
        $car = new Car();
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $polPlates = Plate::whereType(PlateTypeEnum::POLIZIA)->get(['id', 'name']);
        $civPlates = Plate::whereType(PlateTypeEnum::CIVILE)->get(['id', 'name']);
        $origPlates = Plate::whereType(PlateTypeEnum::ORIGINALE)->get(['id', 'name']);
        $equipments = Equipment::get();
        $car_police_plate_id = null;
        $car_civil_plate_id = null;
        $car_origin_plate_id = null;
        $assignee_id = null;
        $offices = Office::get();
        $button = false;

        return view('car.form',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment',
                'car_police_plate_id', 'car_civil_plate_id', 'car_origin_plate_id', 'polPlates', 'civPlates',
                'offices', 'equipments', 'origPlates', 'offices', 'assignee_id', 'button'));
    }

    public function storeForm(StoreCarRequest $request): JsonResponse
    {
        $carBrand = Car::create($request->validated());
        confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");
        return $this->sendResponse($carBrand, 'Vettura creata con successo.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $car = new Car();
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $polPlates = Plate::whereType(PlateTypeEnum::POLIZIA)->get(['id', 'name']);
        $civPlates = Plate::whereType(PlateTypeEnum::CIVILE)->get(['id', 'name']);
        $origPlates = Plate::whereType(PlateTypeEnum::ORIGINALE)->get(['id', 'name']);
        $equipments = Equipment::get();
        $car_police_plate_id = null;
        $car_civil_plate_id = null;
        $car_origin_plate_id = null;
        $assignee_id = null;
        $offices = Office::get();

        return view('car.create',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment',
                'car_police_plate_id', 'car_civil_plate_id', 'car_origin_plate_id', 'polPlates', 'civPlates',
                'offices', 'equipments', 'origPlates', 'offices', 'assignee_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['updated_by'] = Auth::id();
            $car = Car::create($data);
            $this->setRelatedTables($data, $car);
            DB::commit();
            confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");
            return Redirect::route('cars.index')
                ->with('success', 'Vettura aggiornata');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->withErrors('Errore: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $car = Car::with([
            'carType',
            'carOwner',
            'carBrand',
            'carPower',
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
            'carOffices' => fn($q) => $q->wherePivotNull('date_to'),
            'carEquipment' => fn($q) => $q->wherePivotNull('date_to'),
            'movements' => fn($q) => $q->with(['office'])->orderBy('date_to', 'asc')->limit(20),
            'maintenances' => fn($q) => $q->with(['maintenanceGarages', 'maintenanceTypes'])->orderBy('date_to',
                'asc')->limit(10),
        ])
            ->find($id);

        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $car = Car::with([
            'carOffices' => fn($q) => $q->wherePivotNull('date_to'),
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
            'carEquipment' => fn($q) => $q->wherePivotNull('date_to')
        ])->find($id);
        $carEquipmentById = $car->carEquipment()->wherePivotNull('date_to')->get()->keyBy('id');
        // Recupera i dati per le select
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $offices = Office::get();
        $polPlates = Plate::whereType(PlateTypeEnum::POLIZIA)->get(['id', 'name']);
        $civPlates = Plate::whereType(PlateTypeEnum::CIVILE)->get(['id', 'name']);
        $origPlates = Plate::whereType(PlateTypeEnum::ORIGINALE)->get(['id', 'name']);
        $equipments = Equipment::get();
        $car_police_plate_id = $car->carPlates()->wherePivotNull('date_to')->whereType(PlateTypeEnum::POLIZIA)->first();
        $car_civil_plate_id = $car->carPlates()->wherePivotNull('date_to')->whereType(PlateTypeEnum::CIVILE)->get()->first();
        $car_origin_plate_id = $car->carPlates()->wherePivotNull('date_to')->whereType(PlateTypeEnum::ORIGINALE)->get()->first();

        return view('car.edit',
            compact('car', 'carTypes', 'carProfitAccounts', 'carOwners', 'carBrands', 'carPowers', 'offices',
                'carEmployment', 'polPlates', 'civPlates', 'origPlates', 'car_police_plate_id', 'car_civil_plate_id',
                'car_origin_plate_id', 'equipments', 'carEquipmentById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['updated_by'] = Auth::id();
            $car->update($data);
            $this->setRelatedTables($data, $car);
            DB::commit();
            confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");
            return Redirect::route('cars.index')
                ->with('success', 'Vettura aggiornata');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->withErrors('Errore: '.$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Car::find($id)->delete();
        confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");
        return Redirect::route('cars.index')
            ->with('success', 'Vettura cancellata');
    }

    private function setRelatedTables(array $data, Car $car)
    {
        if (!$data['available']) {
            CarsService::setCarUnaivalable($car);
            return;
        }
        $car = CarsService::setOfficeAssignee($car, $data['assignee_id'], $data['date_assignee']);
        $car = CarsService::setCarPLate($car, $data['car_police_plate_id'], PlateTypeEnum::POLIZIA,
            isset($data['car_police_plate_force']));
        $car = CarsService::setCarPLate($car, $data['car_civil_plate_id'],PlateTypeEnum::CIVILE,
            isset($data['car_civil_plate_force']));
        $car = CarsService::setCarPLate($car, $data['car_origin_plate_id'],PlateTypeEnum::ORIGINALE,
            isset($data['car_origin_plate_force']));
        $car = CarsService::setCarEquipments($car, $data['equipments'] ?? []);
    }
}
