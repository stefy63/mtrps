<?php

namespace App\Http\Controllers;

use App\Facades\PlateService;
use App\Http\Requests\CarPlateRequest;
use App\Models\Car;
use App\Models\Plate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Plate::with([
            'cars' => fn($q) => $q->wherePivotNull('date_to')->first(),
        ]);
        // Filtri
        if ($search = $request->search) {
            $query = $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE', "%{$search}%")
                ->orWhereHas('cars', function ($q) use ($search) {
                    $q->where('chassis', 'like', "%{$search}%")
                        ->orWhereHas('carType', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('carBrand', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
        }

        $carPlates = $query->paginate();
        confirmDelete('Cancella Targa!', 'Sei sicuro di voler cancellare questa Targa?');

        return view('car-plate.index', compact('carPlates', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $carPlates->perPage());
    }

    public function getForm(Request $request): View
    {
        $carPlate = new Plate();
        $carPlate->type = $request->type;
        $button = false;

        return view('car-plate.form',
            compact('carPlate', 'button'));
    }

    public function storeForm(CarPlateRequest $request): JsonResponse
    {
        $plate = Plate::create($request->validated());
        return $this->sendResponse($plate, 'Targa creata con successo.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carPlate = new Plate();
        return view('car-plate.create', compact('carPlate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarPlateRequest $request): RedirectResponse
    {
        try {
            Plate::create($request->validated());
            return Redirect::route('car-plates.index')
                ->with('success', 'Targa creata.');

        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->withErrors('Errore: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carPlate = Plate::with([
            'cars' => fn($q) => $q->wherePivotNull('date_to'),
            'cars.carOwner',
            'cars.carOffices',
            'cars.carPlates' => fn($q) => $q->where('plates.id', '<>', $id)->wherePivotNull('date_to'),
        ])->find($id);

        return view('car-plate.show', compact('carPlate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carPlate = Plate::with([
            'cars' => fn($q) => $q->wherePivotNull('date_to'),
        ])->find($id);
        $cars = Car::get();

        return view('car-plate.edit', compact('carPlate', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarPlateRequest $request, Plate $carPlate): RedirectResponse
    {
        try {
            $carPlate->update($request->validated());
            return Redirect::route('car-plates.index')
                ->with('success', 'Targa aggiornata con successo.');

        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->withErrors('Errore: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Plate::find($id)->delete();

        return Redirect::route('car-plates.index')
            ->with('success', 'Car Plate deleted successfully');
    }

    /**
     * Get plates by car for AJAX requests
     */
    public function getByVehicle($carId)
    {
        $plates = Plate::where('car_id', $carId)->get();
        return response()->json($plates);
    }

    /**
     * Get plates by car for AJAX requests
     */
    public function getPlateFree($plateId)
    {
        $plates = Plate::whereId($plateId)->get();
        return response()->json($plates);
    }
}