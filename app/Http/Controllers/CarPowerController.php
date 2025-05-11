<?php

namespace App\Http\Controllers;

use App\Models\CarPower;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarPowerRequest;
use App\Http\Requests\StoreCarPowerRequest;
use App\Http\Requests\UpdateCarPowerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarPowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carPowers = CarPower::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-power.index', compact('carPowers'))
            ->with('i', ($request->input('page', 1) - 1) * $carPowers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carPower = new CarPower();

        return view('car-power.create', compact('carPower'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarPowerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarPowerRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarPower::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-powers.index')
                ->with('toast_success', 'CarPower created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarPower Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarPower $carPower
     * @return View
     */
    public function show(CarPower $carPower): View
    {
        return view('car-power.show', compact('carPower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarPower $carPower
     * @return View
     */
    public function edit(CarPower $carPower): View
    {
        return view('car-power.edit', compact('carPower'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarPowerRequest $request
     * @param CarPower $carPower
     * @return RedirectResponse
     */
    public function update(UpdateCarPowerRequest $request, CarPower $carPower): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carPower->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-powers.index')
                ->with('toast_success', 'CarPower updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarPower Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarPower $carPower
     * @return RedirectResponse
     */
    public function destroy(CarPower $carPower): RedirectResponse
    {
        try {
            $carPower->delete();

            return Redirect::route('car-powers.index')
                ->with('toast_success', 'CarPower deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarPower Not deleted');
        }
    }
}
