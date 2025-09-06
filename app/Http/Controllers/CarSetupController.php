<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarSetup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarSetupRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = CarSetup::with(['car', 'car.carPlates']);
        // Filtro per veicolo
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        // Filtro per categoria
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filtro per stato
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where(function ($q) {
                    $q->whereNotNull('date_to')
                      ->where('date_to', '<', now());
                    });
                }
            }

            // Filtro per periodo
            if ($request->filled('date_from')) {
                $dateTo = $request->filled('date_to') ? $request->date_to : null;
                $query->inPeriod($request->date_from, $dateTo);
            }

            // Ricerca testuale
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhereHas('car', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%")
                        ->orWhereHas('carPlates', function ($q3) use ($search) {
                            $q3->where('name', 'LIKE', "%{$search}%");
                        });
                    });
                });
            }

            // Ordinamento
            $sortField = $request->get('sort', 'date_from');
            $sortDirection = $request->get('direction', 'desc');

            if ($sortField === 'car') {
                $query->leftJoin('cars', 'car_setups.car_id', '=', 'cars.id')
                ->orderBy('cars.name', $sortDirection)
                ->select('car_setups.*');
            } else {
                $query->orderBy($sortField, $sortDirection);
            }

            $carSetups = $query->paginate(20)->withQueryString();


            // Ottieni tutti i veicoli per il filtro
            $cars = Car::with('carPlates')->orderBy('name')->get();
            // Categorie per il filtro
            $categories = CarSetup::SETUP_CATEGORIES;

            // Statistiche
            $stats = [
                'total' => CarSetup::count(),
                'active' => CarSetup::active()->count(),
                'by_category' => []
            ];

        foreach ($categories as $key => $category) {
            $stats['by_category'][$key] = CarSetup::byCategory($key)->count();
        }

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo allestimento?');

        return view('car-setup.index', compact('carSetups', 'cars', 'categories', 'stats'))
            ->with('i', ($request->input('page', 1) - 1) * $carSetups->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carSetup = new CarSetup();

        $cars = Car::with(['carPlates', 'carType', 'carBrand'])->orderBy('name')->get();

        $categories = CarSetup::SETUP_CATEGORIES;

        return view('car-setup.create', compact('carSetup', 'cars', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarSetupRequest $request): RedirectResponse
    {
        try {
            $carSetup = CarSetup::create($request->validated());

            return Redirect::route('car-setups.index')
                ->with('toast_success', 'Allestimento creato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante la creazione: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarSetup $carSetup): View
    {
        $carSetup->load(['car.carPlates', 'car.carType', 'car.carBrand']);

        // Ottieni altri setup dello stesso veicolo
        $relatedSetups = CarSetup::where('car_id', $carSetup->car_id)
            ->where('id', '!=', $carSetup->id)
            ->orderBy('date_from', 'desc')
            ->limit(5)
            ->get();

        return view('car-setup.show', compact('carSetup', 'relatedSetups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarSetup $carSetup): View
    {
        $cars = Car::with(['carPlates', 'carType', 'carBrand'])->orderBy('name')->get();

        $categories = CarSetup::SETUP_CATEGORIES;

        return view('car-setup.edit', compact('carSetup', 'cars', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarSetupRequest $request, CarSetup $carSetup): RedirectResponse
    {
        try {
            $carSetup->update($request->validated());

            return Redirect::route('car-setups.index')
                ->with('toast_success', 'Allestimento aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante l\'aggiornamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarSetup $carSetup): RedirectResponse
    {
        try {
            $carSetup->delete();

            return Redirect::route('car-setups.index')
                ->with('toast_success', 'Allestimento eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore durante l\'eliminazione: ' . $e->getMessage());
        }
    }

    /**
     * Get setup suggestions based on car
     */
    public function getSuggestions(Request $request)
    {
        $carId = $request->get('car_id');

        if (!$carId) {
            return response()->json([]);
        }

        $car = Car::with('carType')->find($carId);

        if (!$car || !$car->car_type_id) {
            return response()->json([]);
        }

        $suggestions = CarSetup::getSuggestionsByCarType($car->car_type_id);

        return response()->json($suggestions);
    }

    /**
     * Check for conflicts
     */
    public function checkConflicts(Request $request)
    {
        $carId = $request->get('car_id');
        $name = $request->get('name');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $excludeId = $request->get('exclude_id');

        if (!$carId || !$name || !$dateFrom) {
            return response()->json(['has_conflicts' => false]);
        }

        $query = CarSetup::where('car_id', $carId)
            ->where('name', $name)
            ->inPeriod($dateFrom, $dateTo);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $conflicts = $query->get();

        return response()->json([
            'has_conflicts' => $conflicts->isNotEmpty(),
            'conflicts' => $conflicts->map(function ($setup) {
                return [
                    'id' => $setup->id,
                    'name' => $setup->name,
                    'period' => $setup->formatted_period
                ];
            })
        ]);
    }
}
