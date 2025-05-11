<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceTypeRequest;
use App\Http\Requests\StoreMaintenanceTypeRequest;
use App\Http\Requests\UpdateMaintenanceTypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaintenanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $maintenanceTypes = MaintenanceType::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('maintenance-type.index', compact('maintenanceTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $maintenanceType = new MaintenanceType();

        return view('maintenance-type.create', compact('maintenanceType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaintenanceTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMaintenanceTypeRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                MaintenanceType::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('maintenance-types.index')
                ->with('toast_success', 'MaintenanceType created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'MaintenanceType Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param MaintenanceType $maintenanceType
     * @return View
     */
    public function show(MaintenanceType $maintenanceType): View
    {
        return view('maintenance-type.show', compact('maintenanceType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MaintenanceType $maintenanceType
     * @return View
     */
    public function edit(MaintenanceType $maintenanceType): View
    {
        return view('maintenance-type.edit', compact('maintenanceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMaintenanceTypeRequest $request
     * @param MaintenanceType $maintenanceType
     * @return RedirectResponse
     */
    public function update(UpdateMaintenanceTypeRequest $request, MaintenanceType $maintenanceType): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $maintenanceType->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('maintenance-types.index')
                ->with('toast_success', 'MaintenanceType updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'MaintenanceType Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param MaintenanceType $maintenanceType
     * @return RedirectResponse
     */
    public function destroy(MaintenanceType $maintenanceType): RedirectResponse
    {
        try {
            $maintenanceType->delete();

            return Redirect::route('maintenance-types.index')
                ->with('toast_success', 'MaintenanceType deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'MaintenanceType Not deleted');
        }
    }
}
