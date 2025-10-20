<?php

namespace App\Http\Controllers;

use App\Models\CarPlate;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarPlateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carPlates = CarPlate::with('car.carBrand', 'car.carType')->paginate();

        confirmDelete('Cancella Targa!', 'Sei sicuro di voler cancellare questa Targa?');

        return view('car-plate.index', compact('carPlates'))
            ->with('i', ($request->input('page', 1) - 1) * $carPlates->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carPlate = new CarPlate();
        
        // Recupera i veicoli per la select
        $cars = Car::with('carBrand', 'carType')->get();
        
        return view('car-plate.create', compact('carPlate', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarPlateRequest $request): RedirectResponse
    {
        CarPlate::create($request->validated());

        return Redirect::route('car-plates.index')
            ->with('success', 'Car Plate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carPlate = CarPlate::with('car', 'car.carBrand', 'car.carType', 'car.carOwner')->find($id);

        confirmDelete('Cancella Targa!', 'Sei sicuro di voler cancellare questa Targa?');

        return view('car-plate.show', compact('carPlate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carPlate = CarPlate::find($id);
        
        // Recupera i veicoli per la select
        $cars = Car::with('carBrand', 'carType')->get();

        return view('car-plate.edit', compact('carPlate', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarPlateRequest $request, CarPlate $carPlate): RedirectResponse
    {
        $carPlate->update($request->validated());

        return Redirect::route('car-plates.index')
            ->with('success', 'Car Plate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarPlate::find($id)->delete();

        return Redirect::route('car-plates.index')
            ->with('success', 'Car Plate deleted successfully');
    }

    /**
     * Get plates by car for AJAX requests
     */
    public function getByVehicle($carId)
    {
        $plates = CarPlate::where('car_id', $carId)->get();
        return response()->json($plates);
    }
}