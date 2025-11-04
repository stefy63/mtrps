<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementRequest;
use App\Models\Car;
use App\Models\Movement;
use App\Models\Office;
use App\Services\FilterCarService;
use App\Services\FilterOfficeService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Movement::with([
            'car.carPlates' => fn($q) => $q->wherePivotNull('date_to'),
            'car.carBrand',
            'office',
        ]);
        // Filtri
        $search = $request->search;
        if ($request->filled('search')) {
            $query->where('code', 'LIKE', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
            $query = FilterCarService::getCarWithFilter($query, $search);
            $query = FilterOfficeService::getOfficeWithFilter($query, $search);
        }

        if ($request->filled('date_from')) {
            $query->where('date_from', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('date_to', '<=', $request->date_to);
        }

        $pending = (clone $query)
            ->whereNull('date_to')
            ->whereNull('date_from')
            ->count();
        $notPending = (clone $query)
            ->whereNotNull('date_to')
            ->whereNotNull('date_from')
            ->whereMonth('date_to', Carbon::now()->month)
            ->count();
        $inProgress = (clone $query)
            ->whereNotNull('date_from')
            ->whereNull('date_to')
            ->count();
        $inProgressMonth = (clone $query)
            ->whereNotNull('date_from')
            ->whereNull('date_to')
            ->whereMonth('date_to', Carbon::now()->month)
            ->count();

        $movements = $query->paginate();

        $cars = Car::with(['carPlates' => fn($q) => $q->wherePivotNull('date_to')])->orderBy('model')->get();
        $stats = [
            'total' => Movement::count(),
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed_month' => $notPending,
            'in_progress_month' => $inProgressMonth,
        ];

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo movimento?');

        return view('movement.index', compact(
            'movements',
            'cars',
            'stats',
            'search'
        ))->with('i', ($request->input('page', 1) - 1) * $movements->perPage());
    }



    /**
     * Show the form for creating a new resource.
     */
    public function getForm(Request $request): View
    {
        $movement = new Movement();
        if ($request->has('car_id')) {
            $movement->car_id = $request->car_id;
        }
        $movement->code = Movement::generateCode();
        $movement->date_from = Carbon::now()->addDay()->setTime(8, 0);
        $cars = Car::with([
            'carBrand',
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
        ])->get();
        $offices = Office::get();
        $button = false;

        return view('movement.form', compact(
            'movement',
            'cars',
            'offices',
            'button'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(MovementRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $movement = Movement::create($data);
            DB::commit();
            return $this->sendResponse($movement, 'Movimento creato con successo.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendError('Errore durante la creazione del movimento.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $movement = new Movement();
        if ($request->has('car_id')) {
            $movement->car_id = $request->car_id;
        }
        $movement->code = Movement::generateCode();
        $movement->date_from = Carbon::now()->addDay()->setTime(8, 0);
        $cars = Car::with([
            'carBrand',
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
        ])->get();
        $offices = Office::get();

        return view('movement.create', compact(
            'movement',
            'cars',
            'offices',
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
            Movement::create($data);
            DB::commit();
            return Redirect::route('movements.index')
                ->with('toast_success', 'Movimento registrato con successo.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante la registrazione del movimento.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movement $movement): View
    {
        $movement->load([
            'car.carPlates' => fn($q) => $q->wherePivotNull('date_to'),
            'car.carPower',
            'office',
        ]);

        return view('movement.show', compact('movement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movement $movement): View
    {
        $cars = Car::with([
            'carPlates' => fn($q) => $q->wherePivotNull('date_to'),
        ])->get();
        $offices = Office::get();

        return view('movement.edit', compact(
            'movement',
            'cars',
            'offices',
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
            $movement->update($data);
            DB::commit();
            return Redirect::route('movements.index')
                ->with('toast_success', 'Movimento aggiornato con successo.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante l\'aggiornamento del movimento: '.$e->getMessage());
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

}
