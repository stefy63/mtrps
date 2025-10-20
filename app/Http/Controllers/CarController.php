<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarEmploymentCode;
use App\Models\CarOwner;
use App\Models\CarPower;
use App\Models\CarProfitAccount;
use App\Models\CarType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $cars = Car::with([
            'carType',
            'carOwner',
            'carBrand',
            'carPower',
            'carProfitAccount',
            'carPlates'
        ])->paginate();

        $title = 'Cancella Vettura!';
        $text = "Sei sicuro di voler cancellare questa vettura?";
        confirmDelete($title, $text);

        return view('car.index', compact('cars'))
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
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment', 'button'));
    }

    public function storeForm(CarRequest $request):  JsonResponse
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

        return view('car.create',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        Car::create($data);

        return Redirect::route('cars.index')
            ->with('success', 'Car created successfully.');
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
            'assignees' => fn ($q) => $q->with('office')->whereNull('date_to'),
            'carEquipment' => fn ($q) => $q->wherePivotNull('date_to'),
            'movements' => fn ($q) => $q->with(['office'])->orderBy('date_to', 'asc')->limit(10),
            'maintenances' => fn ($q) => $q->with(['maintenanceGarages','maintenanceTypes'])->orderBy('date_to', 'asc')->limit(10),
        ])
            ->find($id);
//dd($car->toArray());
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $car = Car::find($id);

        // Recupera i dati per le select
        $carTypes = CarType::get(['id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        $carEmployment = CarEmploymentCode::get(['id', 'extended']);
        $button = true;

        return view('car.edit',
            compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts', 'carEmployment', 'button'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car): RedirectResponse
    {
        $data = $request->validated();
        $data['updated_by'] = Auth::id();

        $car->update($data);

        return Redirect::route('cars.index')
            ->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Car::find($id)->delete();

        return Redirect::route('cars.index')
            ->with('success', 'Car deleted successfully');
    }
}