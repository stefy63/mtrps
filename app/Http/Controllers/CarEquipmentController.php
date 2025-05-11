<?php

namespace App\Http\Controllers;

use App\Models\CarEquipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarEquipmentRequest;
use App\Http\Requests\UpdateCarEquipmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class CarEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carEquipments = CarEquipment::paginate();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare?');
        return view('car-equipment.index', compact('carEquipments'))
            ->with('i', ($request->input('page', 1) - 1) * $carEquipments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carEquipment = new CarEquipment();

        return view('car-equipment.create', compact('carEquipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarEquipmentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarEquipmentRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarEquipment::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'CarEquipment created successfully.');
        } catch (Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarEquipment Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarEquipment $carEquipment
     * @return View
     */
    public function show(CarEquipment $carEquipment): View
    {
        return view('car-equipment.show', compact('carEquipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarEquipment $carEquipment
     * @return View
     */
    public function edit(CarEquipment $carEquipment): View
    {
        return view('car-equipment.edit', compact('carEquipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarEquipmentRequest $request
     * @param CarEquipment $carEquipment
     * @return RedirectResponse
     */
    public function update(UpdateCarEquipmentRequest $request, CarEquipment $carEquipment): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carEquipment->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'CarEquipment updated successfully');
        } catch (Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarEquipment Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarEquipment $carEquipment
     * @return RedirectResponse
     */
    public function destroy(CarEquipment $carEquipment): RedirectResponse
    {
        try {
            $carEquipment->delete();

            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'CarEquipment deleted successfully');
        } catch (Throwable $e) {
            Redirect::back()->with('toast_error', 'CarEquipment Not deleted');
        }
    }
}
