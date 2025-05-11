<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceRequest;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $maintenances = Maintenance::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('maintenance.index', compact('maintenances'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenances->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $maintenance = new Maintenance();

        return view('maintenance.create', compact('maintenance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaintenanceRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMaintenanceRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                Maintenance::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Maintenance created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Maintenance Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Maintenance $maintenance
     * @return View
     */
    public function show(Maintenance $maintenance): View
    {
        return view('maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Maintenance $maintenance
     * @return View
     */
    public function edit(Maintenance $maintenance): View
    {
        return view('maintenance.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMaintenanceRequest $request
     * @param Maintenance $maintenance
     * @return RedirectResponse
     */
    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $maintenance->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Maintenance updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Maintenance Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Maintenance $maintenance
     * @return RedirectResponse
     */
    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        try {
            $maintenance->delete();

            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Maintenance deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Maintenance Not deleted');
        }
    }
}
