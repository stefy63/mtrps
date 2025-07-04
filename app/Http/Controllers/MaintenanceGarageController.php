<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceGarageRequest;
use App\Http\Requests\UpdateMaintenanceGarageRequest;
use App\Models\Maintenance;
use App\Models\MaintenanceGarage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $query = MaintenanceGarage::with(['maintenance.car.carPlates']);

        // Filtri
        if ($request->filled('maintenance_id')) {
            $query->where('maintenance_id', $request->maintenance_id);
        }

        if ($request->filled('acc')) {
            $query->where('acc', $request->acc);
        }

        if ($request->filled('anti_mafia')) {
            $query->where('anti_mafia', $request->anti_mafia);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('piva', 'like', "%{$search}%")
                    ->orWhere('cf', 'like', "%{$search}%")
                    ->orWhere('pec', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            });
        }

        // Ordinamento
        $query->orderBy('created_at', 'desc');

        $maintenanceGarages = $query->paginate(20);

        // Dati per i filtri
        $maintenances = Maintenance::with('car')->orderBy('date_from', 'desc')->get();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questa officina?');

        return view('maintenance-garage.index', compact('maintenanceGarages', 'maintenances'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceGarages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request): View
    {
        $maintenanceGarage = new MaintenanceGarage();
        $maintenances = Maintenance::with(['car.carPlates'])->orderBy('date_from', 'desc')->get();

        // Se viene passato un maintenance_id, preselezionalo
        if ($request->has('maintenance_id')) {
            $maintenanceGarage->maintenance_id = $request->maintenance_id;
        }

        return view('maintenance-garage.create', compact('maintenanceGarage', 'maintenances'));
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
            MaintenanceGarage::create($request->validated());

            $redirectRoute = $request->input('redirect_to_maintenance')
                ? route('maintenances.show', $request->maintenance_id)
                : route('maintenance-garages.index');

            return Redirect::to($redirectRoute)
                ->with('toast_success', 'Officina registrata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione dell\'officina.')
                ->withInput();
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
        $maintenanceGarage->load(['maintenance.car.carPlates', 'cigs']);

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
        $maintenances = Maintenance::with(['car.carPlates'])->orderBy('date_from', 'desc')->get();

        return view('maintenance-garage.edit', compact('maintenanceGarage', 'maintenances'));
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
            $maintenanceGarage->update($request->validated());

            return Redirect::route('maintenance-garages.index')
                ->with('toast_success', 'Officina aggiornata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento dell\'officina.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MaintenanceGarage $maintenanceGarage
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
                ->with('toast_success', 'Officina eliminata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione dell\'officina.');
        }
    }

    /**
     * Get garage suggestions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(Request $request)
    {
        $type = $request->get('type', 'name');

        $suggestions = [];

        if ($type === 'name') {
            // Suggerimenti per nomi officine comuni in Italia
            $suggestions = [
                'Officina Autorizzata Fiat',
                'Officina Autorizzata BMW',
                'Officina Autorizzata Mercedes',
                'Officina Multimarca Certificata',
                'Centro Assistenza Bosch',
                'Euromaster Service',
                'Midas Italia',
                'Centro Revisioni Auto',
                'Carrozzeria Autorizzata',
                'Elettrauto Specializzato',
                'Gommista Pirelli Point',
                'Centro Assistenza Magneti Marelli',
                'Officina Meccanica F.lli Rossi',
                'Autofficina Europa',
                'Centro Riparazioni Rapide'
            ];
        } elseif ($type === 'pec') {
            // Suggerimenti domini PEC comuni
            $suggestions = [
                '@pec.it',
                '@legalmail.it',
                '@pec.aruba.it',
                '@pecimprese.it',
                '@pec.libero.it',
                '@postecert.it'
            ];
        }

        return response()->json($suggestions);
    }

    /**
     * Validate P.IVA
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePiva(Request $request)
    {
        $piva = $request->get('piva');

        // Validazione base P.IVA italiana (11 cifre)
        if (!preg_match('/^[0-9]{11}$/', $piva)) {
            return response()->json([
                'valid' => false,
                'message' => 'La P.IVA deve contenere 11 cifre'
            ]);
        }

        // Algoritmo di controllo P.IVA
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $digit = (int)$piva[$i];
            if ($i % 2 == 0) {
                $sum += $digit;
            } else {
                $double = $digit * 2;
                $sum += $double > 9 ? $double - 9 : $double;
            }
        }

        $checkDigit = (10 - ($sum % 10)) % 10;
        $isValid = $checkDigit == (int)$piva[10];

        return response()->json([
            'valid' => $isValid,
            'message' => $isValid ? 'P.IVA valida' : 'P.IVA non valida'
        ]);
    }
}
