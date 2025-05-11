<?php

namespace App\Http\Controllers;

use App\Models\CarFuel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarFuelRequest;
use App\Http\Requests\StoreCarFuelRequest;
use App\Http\Requests\UpdateCarFuelRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarFuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carFuels = CarFuel::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-fuel.index', compact('carFuels'))
            ->with('i', ($request->input('page', 1) - 1) * $carFuels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carFuel = new CarFuel();

        return view('car-fuel.create', compact('carFuel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarFuelRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarFuelRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarFuel::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'CarFuel created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarFuel Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarFuel $carFuel
     * @return View
     */
    public function show(CarFuel $carFuel): View
    {
        return view('car-fuel.show', compact('carFuel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarFuel $carFuel
     * @return View
     */
    public function edit(CarFuel $carFuel): View
    {
        return view('car-fuel.edit', compact('carFuel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarFuelRequest $request
     * @param CarFuel $carFuel
     * @return RedirectResponse
     */
    public function update(UpdateCarFuelRequest $request, CarFuel $carFuel): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carFuel->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'CarFuel updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarFuel Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarFuel $carFuel
     * @return RedirectResponse
     */
    public function destroy(CarFuel $carFuel): RedirectResponse
    {
        try {
            $carFuel->delete();

            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'CarFuel deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarFuel Not deleted');
        }
    }
}
