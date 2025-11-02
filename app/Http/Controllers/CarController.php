<?php

namespace App\Http\Controllers;

use App\Facades\CarsService;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarEmploymentCode;
use App\Models\CarEquipment;
use App\Models\CarOwner;
use App\Models\CarPlate;
use App\Models\CarPower;
use App\Models\CarProfitAccount;
use App\Models\CarType;
use App\Models\Equipment;
use App\Models\Office;
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
            'carPlates',
            'carOffices' => fn($q) => $q->wherePivotNull('date_to'),
            'carEquipment' => fn($q) => $q->wherePivotNull('date_to'),
        ]);

        // Filtri
        if ($search = $request->search) {
            $query = FilterCarService::getRelationWithFilter($query, $search);
            $query->orWhereHas('carOffices', function ($q) use ($search) {
                $q->where('ente', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })->orWhereHas('carOwner', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('carEquipment', function ($q) use ($search) {
                $q->where('car_equipment.note', 'like', "%{$search}%");
            })->orWhereHas('carPower', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('chassis', 'like', "%{$search}%");
        }

        confirmDelete('Cancella Vettura!', "Sei sicuro di voler cancellare questa vettura?");

        $cars = $query->paginate();
        return view('car.index', compact('cars', 'search'))
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
        $button = false;
        return view('car.form',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment',
                'button'));
    }

    public function storeForm(CarRequest $request): JsonResponse
    {
        $carBrand = Car::create($request->validated());
        return $this->sendResponse($carBrand, 'Vettura creata con successo.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $car = new Car();

        // Recupera i dati per le select
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $button = true;
        $polPlates = CarPlate::whereNull('date_to')->whereType('POLIZIA')->get(['id', 'name']);
        $civPlates = CarPlate::whereNull('date_to')->whereType('CIVILE')->get(['id', 'name']);
        $origPlates = CarPlate::whereNull('date_to')->whereType('ORIGINALE')->get(['id', 'name']);
        $car_police_plate_id = null;
        $car_civil_plate_id = null;
        $car_origin_plate_id = null;
        $assignee_id = 1;
        $offices = Office::get();


        return view('car.create',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment',
                'button', 'car_police_plate_id', 'car_civil_plate_id', 'car_origin_plate_id', 'polPlates', 'civPlates',
                'origPlates', 'offices', 'assignee_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        $car = Car::create($data);
        $car = CarsService::setAssignee($car, $data['assignee_id']);
        dd($car);
        $car->carOffices()->attach($data['assignee_id'], ['date_from' => now()]);

        return Redirect::route('cars.index')
            ->with('toast_success', 'Vettura creata.');
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
            'carPlates',
            'carOffices' => fn($q) => $q->wherePivotNull('date_to'),
//            'assignees' => fn($q) => $q->with('office')->whereNull('date_to'),
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
            'carPlates',
            'carEquipment'
        ])->find($id);
        $carEquipmentById = $car->carEquipment->keyBy('id');
//        dd($car->toArray(), $carEquipmentById->toArray());
        // Recupera i dati per le select
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $offices = Office::get();
        $polPlates = CarPlate::whereNull('date_to')->whereType('POLIZIA')->get(['id', 'name']);
        $civPlates = CarPlate::whereNull('date_to')->whereType('CIVILE')->get(['id', 'name']);
        $origPlates = CarPlate::whereNull('date_to')->whereType('ORIGINALE')->get(['id', 'name']);
        $equipments = Equipment::get();
        $car_police_plate_id = $car->carPlates->whereNull('date_to')->first(fn($c) => $c->type === 'POLIZIA');
        $car_civil_plate_id = $car->carPlates->whereNull('date_to')->first(fn($c) => $c->type === 'CIVILE');
        $car_origin_plate_id = $car->carPlates->whereNull('date_to')->first(fn($c) => $c->type === 'ORIGINALE');

        return view('car.edit',
            compact('car', 'carTypes', 'carProfitAccounts', 'carOwners', 'carBrands', 'carPowers', 'offices',
                'carEmployment', 'polPlates', 'civPlates', 'origPlates', 'car_police_plate_id', 'car_civil_plate_id',
                'car_origin_plate_id', 'equipments', 'carEquipmentById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['updated_by'] = Auth::id();
            $car->load(['carOffices', 'carPlates'])->update($data);
            $car = CarsService::setOfficeAssignee($car, $data['assignee_id'], $data['date_assignee']);
            $car = CarsService::setCarPLate($car, $data['car_police_plate_id'],
                isset($data['car_police_plate_force']));
            $car = CarsService::setCarPLate($car, $data['car_civil_plate_id'],
                isset($data['car_civil_plate_force']));
            $car = CarsService::setCarPLate($car, $data['car_origin_plate_id'],
                isset($data['car_origin_plate_force']));
            $car = CarsService::setCarEquipments($car, $data['equipments'] ?? []);
            DB::commit();
            return Redirect::route('cars.index')
                ->with('toast_success', 'Vettura aggiornata');
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

        return Redirect::route('cars.index')
            ->with('toast_success', 'Vettura cancellata');
    }
}