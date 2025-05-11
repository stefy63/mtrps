<?php

namespace App\Http\Controllers;

use App\Models\CarPlate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarPlateRequest;
use App\Http\Requests\StoreCarPlateRequest;
use App\Http\Requests\UpdateCarPlateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carPlates = CarPlate::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-plate.index', compact('carPlates'))
            ->with('i', ($request->input('page', 1) - 1) * $carPlates->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carPlate = new CarPlate();

        return view('car-plate.create', compact('carPlate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarPlateRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarPlateRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarPlate::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-plates.index')
                ->with('toast_success', 'CarPlate created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarPlate Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarPlate $carPlate
     * @return View
     */
    public function show(CarPlate $carPlate): View
    {
        return view('car-plate.show', compact('carPlate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarPlate $carPlate
     * @return View
     */
    public function edit(CarPlate $carPlate): View
    {
        return view('car-plate.edit', compact('carPlate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarPlateRequest $request
     * @param CarPlate $carPlate
     * @return RedirectResponse
     */
    public function update(UpdateCarPlateRequest $request, CarPlate $carPlate): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carPlate->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-plates.index')
                ->with('toast_success', 'CarPlate updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarPlate Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarPlate $carPlate
     * @return RedirectResponse
     */
    public function destroy(CarPlate $carPlate): RedirectResponse
    {
        try {
            $carPlate->delete();

            return Redirect::route('car-plates.index')
                ->with('toast_success', 'CarPlate deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarPlate Not deleted');
        }
    }
}
