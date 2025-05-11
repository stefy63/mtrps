<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceGarage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceGarageRequest;
use App\Http\Requests\StoreMaintenanceGarageRequest;
use App\Http\Requests\UpdateMaintenanceGarageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaintenanceGarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $maintenanceGarages = MaintenanceGarage::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('maintenance-garage.index', compact('maintenanceGarages'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceGarages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $maintenanceGarage = new MaintenanceGarage();

        return view('maintenance-garage.create', compact('maintenanceGarage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaintenanceGarageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMaintenanceGarageRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                MaintenanceGarage::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('maintenance-garages.index')
                ->with('toast_success', 'MaintenanceGarage created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'MaintenanceGarage Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param MaintenanceGarage $maintenanceGarage
     * @return View
     */
    public function show(MaintenanceGarage $maintenanceGarage): View
    {
        return view('maintenance-garage.show', compact('maintenanceGarage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MaintenanceGarage $maintenanceGarage
     * @return View
     */
    public function edit(MaintenanceGarage $maintenanceGarage): View
    {
        return view('maintenance-garage.edit', compact('maintenanceGarage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMaintenanceGarageRequest $request
     * @param MaintenanceGarage $maintenanceGarage
     * @return RedirectResponse
     */
    public function update(UpdateMaintenanceGarageRequest $request, MaintenanceGarage $maintenanceGarage): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $maintenanceGarage->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('maintenance-garages.index')
                ->with('toast_success', 'MaintenanceGarage updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'MaintenanceGarage Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param MaintenanceGarage $maintenanceGarage
     * @return RedirectResponse
     */
    public function destroy(MaintenanceGarage $maintenanceGarage): RedirectResponse
    {
        try {
            $maintenanceGarage->delete();

            return Redirect::route('maintenance-garages.index')
                ->with('toast_success', 'MaintenanceGarage deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'MaintenanceGarage Not deleted');
        }
    }
}
