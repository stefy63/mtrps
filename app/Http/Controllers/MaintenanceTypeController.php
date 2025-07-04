<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceTypeRequest;
use App\Http\Requests\UpdateMaintenanceTypeRequest;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
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
        $query = MaintenanceType::with(['maintenance.car.carPlates']);

        // Filtri
        if ($request->filled('maintenance_id')) {
            $query->where('maintenance_id', $request->maintenance_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            });
        }

        // Ordinamento
        $query->orderBy('created_at', 'desc');

        $maintenanceTypes = $query->paginate(20);

        // Dati per i filtri
        $maintenances = Maintenance::with('car')->orderBy('date_from', 'desc')->get();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo tipo di intervento?');

        return view('maintenance-type.index', compact('maintenanceTypes', 'maintenances'))
            ->with('i', ($request->input('page', 1) - 1) * $maintenanceTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request): View
    {
        $maintenanceType = new MaintenanceType();
        $maintenances = Maintenance::with(['car.carPlates'])->orderBy('date_from', 'desc')->get();

        // Se viene passato un maintenance_id, preselezionalo
        if ($request->has('maintenance_id')) {
            $maintenanceType->maintenance_id = $request->maintenance_id;
        }

        return view('maintenance-type.create', compact('maintenanceType', 'maintenances'));
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

            $redirectRoute = $request->input('redirect_to_maintenance')
                ? route('maintenances.show', $request->maintenance_id)
                : route('maintenance-types.index');

            return Redirect::to($redirectRoute)
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

    /**
     * Get intervention type suggestions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(Request $request)
    {
        $category = $request->get('category', 'general');

        $suggestions = [];

        // Categorie di interventi
        $categories = [
            'general' => [
                'Controllo Generale',
                'Diagnosi Computerizzata',
                'Controllo Livelli',
                'Verifica Funzionalità',
                'Test su Strada'
            ],
            'motore' => [
                'Cambio Olio Motore',
                'Sostituzione Filtro Olio',
                'Sostituzione Filtro Aria',
                'Cambio Candele',
                'Pulizia Iniettori',
                'Controllo Cinghia Distribuzione',
                'Sostituzione Cinghia Distribuzione',
                'Controllo Cinghia Servizi',
                'Verifica Compressione Cilindri',
                'Controllo Turbina'
            ],
            'freni' => [
                'Controllo Pastiglie Freni',
                'Sostituzione Pastiglie Anteriori',
                'Sostituzione Pastiglie Posteriori',
                'Controllo Dischi Freno',
                'Sostituzione Dischi Anteriori',
                'Sostituzione Dischi Posteriori',
                'Cambio Liquido Freni',
                'Controllo Freno a Mano',
                'Registrazione Freno di Stazionamento'
            ],
            'sospensioni' => [
                'Controllo Ammortizzatori',
                'Sostituzione Ammortizzatori Anteriori',
                'Sostituzione Ammortizzatori Posteriori',
                'Controllo Molle',
                'Verifica Bracci Oscillanti',
                'Controllo Boccole e Silent Block',
                'Equilibratura Ruote',
                'Convergenza e Assetto'
            ],
            'trasmissione' => [
                'Cambio Olio Cambio',
                'Controllo Frizione',
                'Sostituzione Kit Frizione',
                'Verifica Giunti Omocinetici',
                'Controllo Differenziale',
                'Sostituzione Olio Differenziale'
            ],
            'impianto_elettrico' => [
                'Controllo Batteria',
                'Sostituzione Batteria',
                'Verifica Alternatore',
                'Controllo Motorino Avviamento',
                'Diagnosi Centraline',
                'Reset Centraline',
                'Controllo Impianto Luci',
                'Sostituzione Lampadine'
            ],
            'climatizzazione' => [
                'Controllo Climatizzatore',
                'Ricarica Gas Climatizzatore',
                'Igienizzazione Impianto A/C',
                'Sostituzione Filtro Abitacolo',
                'Controllo Compressore A/C',
                'Verifica Perdite Impianto'
            ],
            'carrozzeria' => [
                'Riparazione Ammaccature',
                'Ritocco Vernice',
                'Lucidatura Carrozzeria',
                'Sostituzione Parabrezza',
                'Riparazione Parabrezza',
                'Sostituzione Specchietti',
                'Sistemazione Paraurti'
            ],
            'pneumatici' => [
                'Sostituzione Pneumatici',
                'Inversione Pneumatici',
                'Riparazione Foratura',
                'Controllo Pressione',
                'Controllo Usura Battistrada',
                'Montaggio Pneumatici Invernali',
                'Montaggio Pneumatici Estivi'
            ],
            'scarico' => [
                'Controllo Sistema Scarico',
                'Sostituzione Marmitta',
                'Pulizia FAP/DPF',
                'Rigenerazione FAP/DPF',
                'Controllo Emissioni',
                'Sostituzione Catalizzatore'
            ]
        ];

        if ($category === 'all') {
            // Restituisci tutti gli interventi
            foreach ($categories as $items) {
                $suggestions = array_merge($suggestions, $items);
            }
        } else {
            $suggestions = $categories[$category] ?? $categories['general'];
        }

        return response()->json($suggestions);
    }

    /**
     * Get maintenance type statistics
     *
     * @param Maintenance $maintenance
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics(Maintenance $maintenance)
    {
        $stats = [
            'total_types' => $maintenance->maintenanceTypes()->count(),
            'by_category' => [
                'motore' => $maintenance->maintenanceTypes()->where('name', 'like', '%motore%')->count(),
                'freni' => $maintenance->maintenanceTypes()->where('name', 'like', '%freni%')->count(),
                'elettrico' => $maintenance->maintenanceTypes()->where('name', 'like', '%elettr%')->count(),
                'altro' => $maintenance->maintenanceTypes()
                    ->where('name', 'not like', '%motore%')
                    ->where('name', 'not like', '%freni%')
                    ->where('name', 'not like', '%elettr%')
                    ->count()
            ]
        ];

        return response()->json($stats);
    }
}
