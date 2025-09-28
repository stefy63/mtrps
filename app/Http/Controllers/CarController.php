<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\CarOwner;
use App\Models\CarBrand;
use App\Models\CarPower;
use App\Models\CarProfitAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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

        return view('car.index', compact('cars'))
            ->with('i', ($request->input('page', 1) - 1) * $cars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $car = new Car();

        // Recupera i dati per le select
        $carTypes = CarType::get([ 'id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);
        return view('car.create', compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts'));
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
            'carProfitAccount',
            'createdBy',
            'updatedBy'
        ])->find($id);

        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $car = Car::find($id);

        // Recupera i dati per le select
        $carTypes = CarType::get([ 'id', 'name']);
        $carOwners = CarOwner::get(['id', 'name']);
        $carBrands = CarBrand::get(['id', 'name']);
        $carPowers = CarPower::get(['id', 'name']);
        $carProfitAccounts = CarProfitAccount::get(['id', 'name']);

        return view('car.edit', compact('car', 'carTypes', 'carOwners', 'carBrands', 'carPowers', 'carProfitAccounts'));
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