<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Models\Car;
use App\Models\Maintenance;
use App\Models\MaintenanceGarage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $query = Maintenance::with(['car.carPlates', 'maintenanceGarages', 'maintenanceTypes']);

        // Filtri
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('date_to')->orWhere('date_to', '>=', now());
            } elseif ($request->status === 'completed') {
                $query->whereNotNull('date_to')->where('date_to', '<', now());
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_from', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_from', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%")
                    ->orWhereHas('car', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhereHas('carPlates', function ($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            });
                    });
            });
        }

        // Ordinamento
        $query->orderBy('date_from', 'desc');
        $garages = MaintenanceGarage::get();

        $maintenances = $query->paginate(20);

        // Dati per i filtri
        $cars = Car::with('carPlates')->orderBy('model')->get();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questa manutenzione?');

        return view('maintenance.index', compact('maintenances', 'cars', 'garages'))
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
        $cars = Car::with(['carPlates', 'carBrand'])->orderBy('model')->get();

        return view('maintenance.create', compact('maintenance', 'cars'));
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
            $data = $request->validated();
dd($data);
            // Controlla sovrapposizioni
            if ($this->hasOverlappingMaintenance($data['car_id'], $data['date_from'], $data['date_to'])) {
                return Redirect::back()
                    ->with('toast_error', 'Esiste già una manutenzione per questo veicolo nel periodo selezionato.')
                    ->withInput();
            }

            Maintenance::create($data);

            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Manutenzione registrata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione della manutenzione.')
                ->withInput();
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
        $maintenance->load(['car.carPlates', 'car.carBrand', 'maintenanceGarages', 'maintenanceTypes']);

        // Carica manutenzioni precedenti dello stesso veicolo
        $previousMaintenances = Maintenance::where('car_id', $maintenance->car_id)
            ->where('id', '!=', $maintenance->id)
            ->orderBy('date_from', 'desc')
            ->limit(5)
            ->get();

        return view('maintenance.show', compact('maintenance', 'previousMaintenances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Maintenance $maintenance
     * @return View
     */
    public function edit(Maintenance $maintenance): View
    {
        $cars = Car::with(['carPlates', 'carBrand'])->orderBy('model')->get();

        return view('maintenance.edit', compact('maintenance', 'cars'));
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
            $data = $request->validated();

            // Controlla sovrapposizioni escludendo la manutenzione corrente
            if ($this->hasOverlappingMaintenance($data['car_id'], $data['date_from'], $data['date_to'], $maintenance->id)) {
                return Redirect::back()
                    ->with('toast_error', 'Esiste già una manutenzione per questo veicolo nel periodo selezionato.')
                    ->withInput();
            }

            $maintenance->update($data);

            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Manutenzione aggiornata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento della manutenzione.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Maintenance $maintenance
     * @return RedirectResponse
     */
    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        try {
            // Controlla se ci sono officine o tipi collegati
            if ($maintenance->maintenanceGarages()->exists() || $maintenance->maintenanceTypes()->exists()) {
                return Redirect::back()
                    ->with('toast_error', 'Non puoi eliminare una manutenzione con officine o tipi di intervento collegati.');
            }

            $maintenance->delete();

            return Redirect::route('maintenances.index')
                ->with('toast_success', 'Manutenzione eliminata con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione della manutenzione.');
        }
    }

    /**
     * Check if there are overlapping maintenances
     *
     * @param int $carId
     * @param string $dateFrom
     * @param string|null $dateTo
     * @param int|null $excludeId
     * @return bool
     */
    private function hasOverlappingMaintenance($carId, $dateFrom, $dateTo = null, $excludeId = null): bool
    {
        $query = Maintenance::where('car_id', $carId);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        if ($dateTo) {
            $query->where(function ($q) use ($dateFrom, $dateTo) {
                $q->whereBetween('date_from', [$dateFrom, $dateTo])
                    ->orWhereBetween('date_to', [$dateFrom, $dateTo])
                    ->orWhere(function ($q) use ($dateFrom, $dateTo) {
                        $q->where('date_from', '<=', $dateFrom)
                            ->where('date_to', '>=', $dateTo);
                    });
            });
        } else {
            $query->where(function ($q) use ($dateFrom) {
                $q->where('date_from', '<=', $dateFrom)
                    ->where(function ($q) use ($dateFrom) {
                        $q->whereNull('date_to')
                            ->orWhere('date_to', '>=', $dateFrom);
                    });
            });
        }

        return $query->exists();
    }

    /**
     * Get maintenance suggestions based on car
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(Request $request)
    {
        $carId = $request->get('car_id');
        $type = $request->get('type', 'name');

        $suggestions = [];

        if ($type === 'name') {
            $suggestions = [
                'Tagliando Ordinario',
                'Tagliando Completo',
                'Tagliando Straordinario',
                'Revisione Ministeriale',
                'Controllo Pre-Revisione',
                'Sostituzione Pneumatici',
                'Cambio Olio e Filtri',
                'Manutenzione Freni',
                'Controllo Climatizzatore',
                'Riparazione Carrozzeria',
                'Intervento Meccanico',
                'Intervento Elettrico',
                'Sostituzione Batteria',
                'Controllo Generale',
                'Intervento d\'Urgenza'
            ];
        } elseif ($type === 'description' && $carId) {
            $car = Car::find($carId);
            if ($car) {
                $km = $car->km ?? 0;
                $suggestions = [
                    "Tagliando programmato a {$km} km",
                    'Controllo livelli e rabbocchi',
                    'Sostituzione filtri aria e abitacolo',
                    'Controllo e registrazione freni',
                    'Verifica impianto di raffreddamento',
                    'Controllo sospensioni e ammortizzatori',
                    'Diagnosi elettronica centraline',
                    'Verifica emissioni e scarico'
                ];
            }
        }

        return response()->json($suggestions);
    }

    /**
     * Get maintenance statistics for a specific car
     *
     * @param Car $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics(Car $car)
    {
        $stats = [
            'total_maintenances' => $car->maintenances()->count(),
            'active_maintenances' => $car->maintenances()
                ->where(function ($q) {
                    $q->whereNull('date_to')
                        ->orWhere('date_to', '>=', now());
                })->count(),
            'last_maintenance' => $car->maintenances()->latest('date_from')->first(),
            'yearly_maintenances' => $car->maintenances()
                ->whereYear('date_from', now()->year)
                ->count()
        ];

        return response()->json($stats);
    }
}
