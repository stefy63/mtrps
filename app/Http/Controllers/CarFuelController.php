<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarFuelRequest;
use App\Http\Requests\UpdateCarFuelRequest;
use App\Models\Car;
use App\Models\CarFuel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarFuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = CarFuel::with(['car.carPlates', 'car.carBrand', 'car.carPower', 'user']);

        // Filtri
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
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

        $carFuels = $query->paginate(20);

        // Dati per i filtri
        $cars = Car::with('carPlates')->orderBy('name')->get();
        $users = User::orderBy('name')->get();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo rifornimento?');

        return view('car-fuel.index', compact('carFuels', 'cars', 'users'))
            ->with('i', ($request->input('page', 1) - 1) * $carFuels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carFuel = new CarFuel();
        $cars = Car::with(['carPlates', 'carBrand', 'carPower'])->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('car-fuel.create', compact('carFuel', 'cars', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarFuelRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarFuelRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Se l'utente non è specificato, usa l'utente corrente
            if (!isset($data['user_id'])) {
                $data['user_id'] = Auth::id();
            }

            CarFuel::create($data);

            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'Rifornimento registrato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione del rifornimento.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarFuel $carFuel
     * @return View
     */
    public function show(CarFuel $carFuel): View
    {
        $carFuel->load(['car.carPlates', 'car.carBrand', 'car.carPower', 'user']);

        // Carica rifornimenti precedenti dello stesso veicolo
        $previousFuels = CarFuel::where('car_id', $carFuel->car_id)
            ->where('id', '!=', $carFuel->id)
            ->orderBy('date_from', 'desc')
            ->limit(5)
            ->get();

        return view('car-fuel.show', compact('carFuel', 'previousFuels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarFuel $carFuel
     * @return View
     */
    public function edit(CarFuel $carFuel): View
    {
        $cars = Car::with(['carPlates', 'carBrand', 'carPower'])->orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('car-fuel.edit', compact('carFuel', 'cars', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarFuelRequest $request
     * @param CarFuel $carFuel
     * @return RedirectResponse
     */
    public function update(UpdateCarFuelRequest $request, CarFuel $carFuel): RedirectResponse
    {
        try {
            $carFuel->update($request->validated());

            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'Rifornimento aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento del rifornimento.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarFuel $carFuel
     * @return RedirectResponse
     */
    public function destroy(CarFuel $carFuel): RedirectResponse
    {
        try {
            $carFuel->delete();

            return Redirect::route('car-fuels.index')
                ->with('toast_success', 'Rifornimento eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione del rifornimento.');
        }
    }

    /**
     * Get fuel suggestions based on car and fuel type
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(Request $request)
    {
        $carId = $request->get('car_id');
        $type = $request->get('type', 'name');

        $suggestions = [];

        if ($carId) {
            $car = Car::with('carPower')->find($carId);

            if ($car && $car->carPower) {
                $powerType = strtolower($car->carPower->name);

                // Suggerimenti basati sul tipo di alimentazione
                if ($type === 'name') {
                    if (str_contains($powerType, 'benzina')) {
                        $suggestions = [
                            'Rifornimento Benzina Verde',
                            'Rifornimento Benzina 98',
                            'Rifornimento Benzina 100',
                            'Pieno Benzina Verde',
                            'Rabbocco Benzina'
                        ];
                    } elseif (str_contains($powerType, 'diesel') || str_contains($powerType, 'gasolio')) {
                        $suggestions = [
                            'Rifornimento Diesel',
                            'Rifornimento Gasolio Premium',
                            'Rifornimento Blue Diesel',
                            'Pieno Diesel',
                            'Rabbocco Gasolio'
                        ];
                    } elseif (str_contains($powerType, 'gpl')) {
                        $suggestions = [
                            'Rifornimento GPL',
                            'Pieno GPL',
                            'Rabbocco GPL'
                        ];
                    } elseif (str_contains($powerType, 'metano')) {
                        $suggestions = [
                            'Rifornimento Metano',
                            'Pieno Metano',
                            'Rabbocco Metano'
                        ];
                    } elseif (str_contains($powerType, 'elettric')) {
                        $suggestions = [
                            'Ricarica Completa',
                            'Ricarica Rapida',
                            'Ricarica Parziale',
                            'Ricarica Notturna',
                            'Ricarica Fast Charge'
                        ];
                    } elseif (str_contains($powerType, 'ibrid')) {
                        $suggestions = [
                            'Rifornimento Benzina + Ricarica',
                            'Solo Rifornimento Benzina',
                            'Solo Ricarica Elettrica',
                            'Pieno Benzina',
                            'Ricarica Completa'
                        ];
                    }
                }
            }
        }

        return response()->json($suggestions);
    }

    /**
     * Get statistics for a specific car
     *
     * @param Car $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics(Car $car)
    {
        $stats = [
            'total_fuels' => $car->carFuels()->count(),
            'last_fuel' => $car->carFuels()->latest('date_from')->first(),
            'monthly_count' => $car->carFuels()
                ->whereMonth('date_from', now()->month)
                ->whereYear('date_from', now()->year)
                ->count(),
            'yearly_count' => $car->carFuels()
                ->whereYear('date_from', now()->year)
                ->count()
        ];

        return response()->json($stats);
    }
}
