<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceTypeRequest;
use App\Http\Requests\UpdateMaintenanceTypeRequest;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $query = MaintenanceType::with(['maintenance']);
        $query->orderBy('name');
        $maintenanceTypes = $query->paginate(20);
        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo tipo di intervento?');

        return view('maintenance-type.index', compact('maintenanceTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function getForm(): View
    {
        $maintenanceType = new MaintenanceType();
        $button = false;
        return view('maintenance-type.form', compact('maintenanceType', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMaintenanceTypeRequest $request
     * @return JsonResponse
     */
    public function storeForm(StoreMaintenanceTypeRequest $request): JsonResponse
    {
        try {
            MaintenanceType::create($request->validated());

            return $this->sendResponse('toast_success', 'Tipo di intervento registrato con successo.');
        } catch (\Throwable $e) {
            return $this->sendError('Errore nella registrazione del tipo di intervento.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request): View
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
            MaintenanceType::create($request->validated());

            return Redirect::to('maintenance-types.index')
                ->with('toast_success', 'Tipo di intervento registrato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione del tipo di intervento.')
                ->withInput();
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
        $maintenanceType->load(['maintenance.car.carPlates', 'maintenance.maintenanceGarages']);

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
        $maintenances = Maintenance::with(['car.carPlates'])->orderBy('date_from', 'desc')->get();

        return view('maintenance-type.edit', compact('maintenanceType', 'maintenances'));
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
            $maintenanceType->update($request->validated());

            return Redirect::route('maintenance-types.index')
                ->with('toast_success', 'Tipo di intervento aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento del tipo di intervento.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MaintenanceType $maintenanceType
     * @return RedirectResponse
     */
    public function destroy(MaintenanceType $maintenanceType): RedirectResponse
    {
        try {
            $maintenanceType->delete();

            return Redirect::route('maintenance-types.index')
                ->with('toast_success', 'Tipo di intervento eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione del tipo di intervento.');
        }
    }
}
