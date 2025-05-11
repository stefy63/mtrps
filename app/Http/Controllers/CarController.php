<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPlate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $cars = Car::with([
            'carType',
            'carOwner',
            'carBrand',
            'carPower',
            'carProfitAccount',
            'carPlates',
        ])->paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car.index', compact('cars'))
            ->with('i', ($request->input('page', 1) - 1) * $cars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $car = new Car();

        return view('car.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                Car::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('cars.index')
                ->with('toast_success', 'Car created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Car Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Car $car
     * @return View
     */
    public function show(Car $car): View
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Car $car
     * @return View
     */
    public function edit(Car $car): View
    {
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarRequest $request
     * @param Car $car
     * @return RedirectResponse
     */
    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $car->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('cars.index')
                ->with('toast_success', 'Car updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Car Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Car $car
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        try {
            $car->delete();

            return Redirect::route('cars.index')
                ->with('toast_success', 'Car deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Car Not deleted');
        }
    }
}
