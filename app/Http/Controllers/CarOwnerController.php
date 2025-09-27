<?php

namespace App\Http\Controllers;

use App\Models\CarOwner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarOwnerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carOwners = CarOwner::paginate();

        return view('car-owner.index', compact('carOwners'))
            ->with('i', ($request->input('page', 1) - 1) * $carOwners->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carOwner = new CarOwner();

        return view('car-owner.create', compact('carOwner'));
    }

    public function getForm(): View
    {
        return view('car-owner.modal-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarOwnerRequest $request): RedirectResponse
    {
        CarOwner::create($request->validated());

        return Redirect::route('car-owners.index')
            ->with('success', 'Car Owner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carOwner = CarOwner::with(['cars.carBrand', 'cars.carType', 'cars.carPower', 'cars.carPlates'])->find($id);

        return view('car-owner.show', compact('carOwner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carOwner = CarOwner::find($id);

        return view('car-owner.edit', compact('carOwner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarOwnerRequest $request, CarOwner $carOwner): RedirectResponse
    {
        $carOwner->update($request->validated());

        return Redirect::route('car-owners.index')
            ->with('success', 'Car Owner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $carOwner = CarOwner::find($id);

        // Controlla se ci sono veicoli associati
        if ($carOwner->cars()->count() > 0) {
            return Redirect::route('car-owners.index')
                ->with('error', 'Cannot delete owner with associated vehicles. Please reassign vehicles first.');
        }

        $carOwner->delete();

        return Redirect::route('car-owners.index')
            ->with('success', 'Car Owner deleted successfully');
    }

    /**
     * Get statistics for all owners
     */
    public function statistics()
    {
        $statistics = CarOwner::withCount('cars')
            ->with(['cars' => function($query) {
                $query->selectRaw('car_owner_id, SUM(km) as total_km, AVG(km) as avg_km')
                      ->groupBy('car_owner_id');
            }])
            ->get();

        return response()->json($statistics);
    }
}
