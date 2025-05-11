<?php

namespace App\Http\Controllers;

use App\Models\CarSetup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarSetupRequest;
use App\Http\Requests\StoreCarSetupRequest;
use App\Http\Requests\UpdateCarSetupRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carSetups = CarSetup::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-setup.index', compact('carSetups'))
            ->with('i', ($request->input('page', 1) - 1) * $carSetups->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carSetup = new CarSetup();

        return view('car-setup.create', compact('carSetup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarSetupRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarSetupRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarSetup::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-setups.index')
                ->with('toast_success', 'CarSetup created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarSetup Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarSetup $carSetup
     * @return View
     */
    public function show(CarSetup $carSetup): View
    {
        return view('car-setup.show', compact('carSetup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarSetup $carSetup
     * @return View
     */
    public function edit(CarSetup $carSetup): View
    {
        return view('car-setup.edit', compact('carSetup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarSetupRequest $request
     * @param CarSetup $carSetup
     * @return RedirectResponse
     */
    public function update(UpdateCarSetupRequest $request, CarSetup $carSetup): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carSetup->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-setups.index')
                ->with('toast_success', 'CarSetup updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarSetup Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarSetup $carSetup
     * @return RedirectResponse
     */
    public function destroy(CarSetup $carSetup): RedirectResponse
    {
        try {
            $carSetup->delete();

            return Redirect::route('car-setups.index')
                ->with('toast_success', 'CarSetup deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarSetup Not deleted');
        }
    }
}
