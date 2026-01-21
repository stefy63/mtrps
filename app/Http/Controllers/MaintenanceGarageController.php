<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceGarageRequest;
use App\Http\Requests\UpdateMaintenanceGarageRequest;
use App\Models\MaintenanceGarage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaintenanceGarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = MaintenanceGarage::with('maintenances.car.carPlates')
            ->withCount('maintenances')
            ->orderBy('maintenances_count', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->when($search === 'acc', fn($q) => $q->orWhere('acc', true))
                    ->when($search === 'mafia', fn($q) => $q->orWhere('anti_mafia', true))
                    ->orWhere('piva', 'like', "%{$search}%")
                    ->orWhere('cf', 'like', "%{$search}%")
                    ->orWhere('pec', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            });
        }
        $maintenanceGarages = $query->paginate(20);

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questa officina?');

        return view('maintenance-garage.index', compact('maintenanceGarages'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceGarages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function getForm(): View
    {
        $maintenanceGarage = new MaintenanceGarage();
        $button = false;

        return view('maintenance-garage.form', compact('maintenanceGarage', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMaintenanceGarageRequest  $request
     * @return RedirectResponse
     */
    public function storeForm(StoreMaintenanceGarageRequest $request): JsonResponse
    {
        try {
            MaintenanceGarage::create($request->validated());
            return $this->sendResponse('success', 'Officina registrata con successo.');
        } catch (\Throwable $e) {
            return $this->sendError('Errore nella registrazione dell\'officina.');
        }
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
     * @param  StoreMaintenanceGarageRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreMaintenanceGarageRequest $request): RedirectResponse
    {
        try {
            MaintenanceGarage::create($request->validated());
            return Redirect::to('maintenance-garages.index')
                ->with('success', 'Officina registrata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione dell\'officina.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  MaintenanceGarage  $maintenanceGarage
     * @return View
     */
    public function show(MaintenanceGarage $maintenanceGarage): View
    {
        return view('maintenance-garage.show', compact('maintenanceGarage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MaintenanceGarage  $maintenanceGarage
     * @return View
     */
    public function edit(MaintenanceGarage $maintenanceGarage): View
    {
        return view('maintenance-garage.edit', compact('maintenanceGarage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateMaintenanceGarageRequest  $request
     * @param  MaintenanceGarage  $maintenanceGarage
     * @return RedirectResponse
     */
    public function update(
        UpdateMaintenanceGarageRequest $request,
        MaintenanceGarage $maintenanceGarage
    ): RedirectResponse {
        try {
            $maintenanceGarage->update($request->validated());

            return Redirect::route('maintenance-garages.index')
                ->with('success', 'Officina aggiornata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento dell\'officina.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MaintenanceGarage  $maintenanceGarage
     * @return RedirectResponse
     */
    public function destroy(MaintenanceGarage $maintenanceGarage): RedirectResponse
    {
        try {
            // Controlla se ci sono CIG collegati
            if ($maintenanceGarage->cigs()->exists()) {
                return Redirect::back()
                    ->with('toast_error', 'Non puoi eliminare un\'officina con CIG collegati.');
            }

            $maintenanceGarage->delete();

            return Redirect::route('maintenance-garages.index')
                ->with('success', 'Officina eliminata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione dell\'officina.');
        }
    }

}
