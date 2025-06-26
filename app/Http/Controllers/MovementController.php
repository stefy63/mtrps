<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Movement::with([
            'car.carPlates' => function ($query) {
                $query->orderBy('date_from', 'desc');
            },
            'car.carBrand',
            'driver',
            'requester'
        ]);

        // Filtri
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('departure_location', 'like', "%{$search}%")
                    ->orWhere('arrival_location', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhereHas('car', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('car.carPlates', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('driver', function ($q4) use ($search) {
                        $q4->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('driver_id')) {
            $query->where('driver_id', $request->driver_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $query->where('departure_datetime', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('departure_datetime', '<=', $request->date_to . ' 23:59:59');
        }

        // Ordinamento
        $sortField = $request->get('sort', 'departure_datetime');
        $sortDirection = $request->get('direction', 'desc');

        $query->orderBy($sortField, $sortDirection);

        $movements = $query->paginate();

        // Dati per i filtri
        $cars = Car::with('carPlates')->orderBy('name')->get();
        $drivers = User::orderBy('name')->get();
        $statuses = Movement::getStatuses();
        $types = Movement::getTypes();

        // Statistiche
        $stats = [
            'total' => Movement::count(),
            'pending' => Movement::pending()->count(),
            'in_progress' => Movement::inProgress()->count(),
            'completed_month' => Movement::completed()
                ->whereMonth('departure_datetime', Carbon::now()->month)
                ->count(),
            'total_km_month' => Movement::completed()
                ->whereMonth('departure_datetime', Carbon::now()->month)
                ->sum('km_total'),
        ];

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo movimento?');

        return view('movement.index', compact(
            'movements',
            'cars',
            'drivers',
            'statuses',
            'types',
            'stats'
        ))->with('i', ($request->input('page', 1) - 1) * $movements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $movement = new Movement();

        // Pre-popola se viene passato un car_id
        if ($request->has('car_id')) {
            $movement->car_id = $request->car_id;
        }

        // Genera il codice movimento
        $movement->code = Movement::generateCode();

        // Imposta date di default
        $movement->departure_datetime = Carbon::now()->addDay()->setTime(8, 0);
        $movement->arrival_datetime = Carbon::now()->addDay()->setTime(18, 0);

        $cars = Car::with(['carPlates' => function ($query) {
            $query->orderBy('date_from', 'desc');
        }])->orderBy('name')->get();

        $drivers = User::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $statuses = Movement::getStatuses();
        $types = Movement::getTypes();

        // Suggerimenti destinazioni frequenti
        $frequentDestinations = $this->getFrequentDestinations();

        return view('movement.create', compact(
            'movement',
            'cars',
            'drivers',
            'users',
            'statuses',
            'types',
            'frequentDestinations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovementRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['created_by'] = Auth::id();

            $movement = Movement::create($data);

            DB::commit();

            return Redirect::route('movements.index')
                ->with('toast_success', 'Movimento registrato con successo.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante la registrazione del movimento: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movement $movement): View
    {
        $movement->load([
            'car.carPlates',
            'car.carBrand',
            'car.carType',
            'car.carPower',
            'driver',
            'requester',
            'authorizer',
            'creator',
            'updater'
        ]);

        // Timeline del movimento
        $timeline = $this->buildMovementTimeline($movement);

        return view('movement.show', compact('movement', 'timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movement $movement): View
    {
        $cars = Car::with(['carPlates' => function ($query) {
            $query->orderBy('date_from', 'desc');
        }])->orderBy('name')->get();

        $drivers = User::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $statuses = Movement::getStatuses();
        $types = Movement::getTypes();

        // Suggerimenti destinazioni frequenti
        $frequentDestinations = $this->getFrequentDestinations();

        // Ultimo km del veicolo
        $lastKm = $this->getLastKmForCar($movement->car_id, $movement->id);

        return view('movement.edit', compact(
            'movement',
            'cars',
            'drivers',
            'users',
            'statuses',
            'types',
            'frequentDestinations',
            'lastKm'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovementRequest $request, Movement $movement): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['updated_by'] = Auth::id();

            $movement->update($data);

            DB::commit();

            return Redirect::route('movements.index')
                ->with('toast_success', 'Movimento aggiornato con successo.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante l\'aggiornamento del movimento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movement $movement): RedirectResponse
    {
        try {
            // Non elimina fisicamente ma fa soft delete
            $movement->delete();

            return Redirect::route('movements.index')
                ->with('toast_success', 'Movimento cancellato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore durante la cancellazione del movimento.');
        }
    }

    /**
     * Update movement status
     */
    public function updateStatus(Request $request, Movement $movement): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(Movement::getStatuses()))]
        ]);

        try {
            $movement->update([
                'status' => $request->status,
                'updated_by' => Auth::id()
            ]);

            // Se approva, imposta authorized_by
            if ($request->status === Movement::STATUS_APPROVED && !$movement->authorized_by) {
                $movement->update(['authorized_by' => Auth::id()]);
            }

            return Redirect::back()
                ->with('toast_success', 'Stato del movimento aggiornato.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore durante l\'aggiornamento dello stato.');
        }
    }

    /**
     * Get car availability for date range
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'departure_datetime' => 'required|date',
            'arrival_datetime' => 'required|date|after:departure_datetime',
            'exclude_id' => 'nullable|exists:movements,id'
        ]);

        $conflictingMovements = Movement::where('car_id', $request->car_id)
            ->where('status', '!=', Movement::STATUS_CANCELLED)
            ->where(function ($query) use ($request) {
                $query->whereBetween('departure_datetime', [$request->departure_datetime, $request->arrival_datetime])
                    ->orWhereBetween('arrival_datetime', [$request->departure_datetime, $request->arrival_datetime])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('departure_datetime', '<=', $request->departure_datetime)
                            ->where('arrival_datetime', '>=', $request->arrival_datetime);
                    });
            });

        if ($request->exclude_id) {
            $conflictingMovements->where('id', '!=', $request->exclude_id);
        }

        $conflicts = $conflictingMovements->with('driver')->get();

        return response()->json([
            'available' => $conflicts->isEmpty(),
            'conflicts' => $conflicts
        ]);
    }

    /**
     * Get last km for a car
     */
    public function getLastKm(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id'
        ]);

        $lastKm = $this->getLastKmForCar($request->car_id);

        return response()->json([
            'last_km' => $lastKm
        ]);
    }

    /**
     * Helper: Get frequent destinations
     */
    private function getFrequentDestinations(): array
    {
        $destinations = Movement::select('arrival_location', DB::raw('count(*) as count'))
            ->groupBy('arrival_location')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->pluck('arrival_location')
            ->toArray();

        // Aggiungi destinazioni predefinite per enti pubblici
        $defaultDestinations = [
            'Palazzo del Governo - Roma',
            'Aeroporto Fiumicino',
            'Aeroporto Malpensa',
            'Stazione Centrale Milano',
            'Stazione Termini Roma',
            'Centro Congressi EUR',
            'Fiera Milano Rho',
            'Ministero dell\'Interno - Roma',
            'Questura',
            'Tribunale',
        ];

        return array_unique(array_merge($destinations, $defaultDestinations));
    }

    /**
     * Helper: Get last km for car
     */
    private function getLastKmForCar($carId, $excludeId = null): ?int
    {
        $query = Movement::where('car_id', $carId)
            ->where('status', Movement::STATUS_COMPLETED)
            ->whereNotNull('km_end');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $lastMovement = $query->orderBy('actual_arrival', 'desc')
            ->orderBy('arrival_datetime', 'desc')
            ->first();

        return $lastMovement?->km_end;
    }

    /**
     * Helper: Build movement timeline
     */
    private function buildMovementTimeline(Movement $movement): array
    {
        $timeline = [];

        // Creazione
        $timeline[] = [
            'date' => $movement->created_at,
            'type' => 'created',
            'description' => 'Movimento creato',
            'user' => $movement->creator?->name ?? 'Sistema'
        ];

        // Approvazione
        if ($movement->authorized_by && $movement->status != Movement::STATUS_PENDING) {
            $timeline[] = [
                'date' => $movement->updated_at,
                'type' => 'approved',
                'description' => 'Movimento approvato',
                'user' => $movement->authorizer->name
            ];
        }

        // Partenza
        if ($movement->actual_departure) {
            $timeline[] = [
                'date' => $movement->actual_departure,
                'type' => 'departed',
                'description' => 'Partenza effettiva',
                'user' => $movement->driver->name
            ];
        }

        // Arrivo
        if ($movement->actual_arrival) {
            $timeline[] = [
                'date' => $movement->actual_arrival,
                'type' => 'arrived',
                'description' => 'Arrivo effettivo',
                'user' => $movement->driver->name
            ];
        }

        // Completamento
        if ($movement->status === Movement::STATUS_COMPLETED) {
            $timeline[] = [
                'date' => $movement->updated_at,
                'type' => 'completed',
                'description' => 'Movimento completato',
                'user' => $movement->updater?->name ?? 'Sistema'
            ];
        }

        // Cancellazione
        if ($movement->status === Movement::STATUS_CANCELLED) {
            $timeline[] = [
                'date' => $movement->updated_at,
                'type' => 'cancelled',
                'description' => 'Movimento annullato',
                'user' => $movement->updater?->name ?? 'Sistema'
            ];
        }

        // Ordina per data
        usort($timeline, function ($a, $b) {
            return $a['date']->timestamp - $b['date']->timestamp;
        });

        return $timeline;
    }
}
