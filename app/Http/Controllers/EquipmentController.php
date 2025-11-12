<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarEquipmentRequest;
use App\Http\Requests\UpdateCarEquipmentRequest;
use App\Models\Equipment;
use App\Services\FilterCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = '';
        $query = Equipment::with([
            'cars.carPlates',
        ]);
        if ($request->has('search') && $search = $request->search) {
            $query = FilterCarService::getCarWithFilter($query, $search, 'cars');
        }

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo equipaggiamento?');
        $carEquipments = $query->paginate();

        return view('car-equipment.index', compact('carEquipments', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $carEquipments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function getForm(): View
    {
        $carEquipment = new Equipment();
        $button = false;
        return view('car-equipment.form', compact('carEquipment', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCarEquipmentRequest  $request
     * @return JsonResponse
     */
    public function storeForm(StoreCarEquipmentRequest $request): JsonResponse
    {
        try {
            $equipment = Equipment::create($request->validated());
            return $this->sendResponse($equipment, 'Equipaggiamento creato con successo.');
        } catch (\Throwable $e) {
            return $this->sendError( 'Errore nella creazione dell\'equipaggiamento: '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carEquipment = new Equipment();

        return view('car-equipment.create', compact('carEquipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCarEquipmentRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreCarEquipmentRequest $request): RedirectResponse
    {
        try {
            Equipment::create($request->validated());
            return Redirect::route('equipments.index')
                ->with('success', 'Equipaggiamento creato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('errors', 'Errore nella creazione dell\'equipaggiamento: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Equipment  $equipment
     * @return View
     */
    public function show(Equipment $equipment): View
    {
        $carEquipment = $equipment->load('cars');
        return view('car-equipment.show', compact('carEquipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Equipment  $equipment
     * @return View
     */
    public function edit(Equipment $equipment): View
    {
        $carEquipment = $equipment;
        return view('car-equipment.edit', compact('carEquipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCarEquipmentRequest  $request
     * @param  Equipment  $equipment
     * @return RedirectResponse
     */
    public function update(UpdateCarEquipmentRequest $request, Equipment $equipment): RedirectResponse
    {
        try {
            $equipment->update($request->validated());
            return Redirect::route('equipments.index')
                ->with('success', 'Equipaggiamento aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('errors', 'Errore nell\'aggiornamento dell\'equipaggiamento: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Equipment  $equipment
     * @return RedirectResponse
     */
    public function destroy(Equipment $equipment): RedirectResponse
    {
        try {
            $equipment->delete();
            return Redirect::route('equipments.index')
                ->with('success', 'Equipaggiamento eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione dell\'equipaggiamento: '.$e->getMessage());
        }
    }
}
