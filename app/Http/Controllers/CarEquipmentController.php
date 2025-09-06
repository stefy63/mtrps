<?php

namespace App\Http\Controllers;

use App\Models\CarEquipment;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarEquipmentRequest;
use App\Http\Requests\UpdateCarEquipmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = CarEquipment::with([
            'car',
            'car.carPlates' => function($query) {
                $query->whereNull('date_to')
                      ->orWhere('date_to', '>=', now())
                      ->orderBy('date_from', 'desc');
            },
            'car.carType',
            'car.carBrand'
        ]);

        // Filtro per veicolo
        if ($request->has('car_id') && $request->car_id) {
            $query->where('car_id', $request->car_id);
        }

        // Filtro per stato (attivo/inattivo)
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        // Ricerca
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $carEquipments = $query->orderBy('date_from', 'desc')->paginate();

        // Lista veicoli per il filtro
        $cars = Car::with(['carPlates' => function($query) {
            $query->whereNull('date_to')
                  ->orWhere('date_to', '>=', now());
        }])->orderBy('name')->get();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo equipaggiamento?');

        return view('car-equipment.index', compact('carEquipments', 'cars'))
            ->with('i', ($request->input('page', 1) - 1) * $carEquipments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carEquipment = new CarEquipment();
        $cars = Car::with(['carPlates' => function($query) {
            $query->whereNull('date_to')
                  ->orWhere('date_to', '>=', now())
                  ->orderBy('date_from', 'desc');
        }, 'carType', 'carBrand'])->orderBy('name')->get();

        return view('car-equipment.create', compact('carEquipment', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarEquipmentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarEquipmentRequest $request): RedirectResponse
    {
        try {
            CarEquipment::create($request->validated());

            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'Equipaggiamento creato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore nella creazione dell\'equipaggiamento: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarEquipment $carEquipment
     * @return View
     */
    public function show(CarEquipment $carEquipment): View
    {
        $carEquipment->load([
            'car',
            'car.carPlates' => function($query) {
                $query->orderBy('date_from', 'desc');
            },
            'car.carType',
            'car.carBrand',
            'car.carOwner',
            'car.carPower'
        ]);

        // Altri equipaggiamenti dello stesso veicolo
        $otherEquipments = CarEquipment::where('car_id', $carEquipment->car_id)
            ->where('id', '!=', $carEquipment->id)
            ->orderBy('date_from', 'desc')
            ->get();

        return view('car-equipment.show', compact('carEquipment', 'otherEquipments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarEquipment $carEquipment
     * @return View
     */
    public function edit(CarEquipment $carEquipment): View
    {
        $cars = Car::with(['carPlates' => function($query) {
            $query->whereNull('date_to')
                  ->orWhere('date_to', '>=', now())
                  ->orderBy('date_from', 'desc');
        }, 'carType', 'carBrand'])->orderBy('name')->get();

        return view('car-equipment.edit', compact('carEquipment', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarEquipmentRequest $request
     * @param CarEquipment $carEquipment
     * @return RedirectResponse
     */
    public function update(UpdateCarEquipmentRequest $request, CarEquipment $carEquipment): RedirectResponse
    {
        try {
            $carEquipment->update($request->validated());

            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'Equipaggiamento aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore nell\'aggiornamento dell\'equipaggiamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarEquipment $carEquipment
     * @return RedirectResponse
     */
    public function destroy(CarEquipment $carEquipment): RedirectResponse
    {
        try {
            $carEquipment->delete();

            return Redirect::route('car-equipments.index')
                ->with('toast_success', 'Equipaggiamento eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione dell\'equipaggiamento: ' . $e->getMessage());
        }
    }
}
