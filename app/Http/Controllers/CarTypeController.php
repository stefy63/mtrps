<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarTypeRequest;
use App\Http\Requests\StoreCarTypeRequest;
use App\Http\Requests\UpdateCarTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carTypes = CarType::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-type.index', compact('carTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $carTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carType = new CarType();

        return view('car-type.create', compact('carType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarTypeRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarType::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-types.index')
                ->with('toast_success', 'CarType created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarType Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarType $carType
     * @return View
     */
    public function show(CarType $carType): View
    {
        return view('car-type.show', compact('carType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarType $carType
     * @return View
     */
    public function edit(CarType $carType): View
    {
        return view('car-type.edit', compact('carType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarTypeRequest $request
     * @param CarType $carType
     * @return RedirectResponse
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carType->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-types.index')
                ->with('toast_success', 'CarType updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarType Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarType $carType
     * @return RedirectResponse
     */
    public function destroy(CarType $carType): RedirectResponse
    {
        try {
            $carType->delete();

            return Redirect::route('car-types.index')
                ->with('toast_success', 'CarType deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarType Not deleted');
        }
    }
}
