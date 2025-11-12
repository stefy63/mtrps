<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCigRequest;
use App\Http\Requests\UpdateCigRequest;
use App\Models\Car;
use App\Models\Cig;
use App\Models\MaintenanceGarage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Cig::with([
            'car.carPlates',
            'maintenanceGarage.maintenance',
            'userRup',
            'userSupport',
            'userTenderNotice',
            'userTester'
        ]);

        // Filtri
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('maintenance_garage_id')) {
            $query->where('maintenance_garage_id', $request->maintenance_garage_id);
        }

        if ($request->filled('year')) {
            $query->whereYear('date', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('cig', 'like', "%{$search}%")
                    ->orWhere('ce', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            });
        }

        // Ordinamento
        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');

        $cigs = $query->paginate(20);

        // Dati per i filtri
        $cars = Car::with('carPlates')->orderBy('model')->get();
        $garages = MaintenanceGarage::with('maintenance')->orderBy('name')->get();
        $years = Cig::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Calcola totali
        $totals = [
            'count' => $cigs->total(),
            'taxable' => Cig::sum('taxable'),
            'vat' => Cig::sum('vat'),
            'total' => Cig::selectRaw('SUM(taxable + vat) as total')->value('total')
        ];

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo CIG?');

        return view('cig.index', compact('cigs', 'cars', 'garages', 'years', 'totals'))
            ->with('i', ($request->input('page', 1) - 1) * $cigs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request): View
    {
        $cig = new Cig();
        $cars = Car::with(['carPlates', 'carBrand'])->orderBy('model')->get();
        $garages = MaintenanceGarage::with(['maintenance.car'])->orderBy('name')->get();
        $users = User::orderBy('name')->get();

        // Se viene passato un maintenance_garage_id, preselezionalo
        if ($request->has('maintenance_garage_id')) {
            $cig->maintenance_garage_id = $request->maintenance_garage_id;
            // Preseleziona anche il veicolo
            $garage = MaintenanceGarage::find($request->maintenance_garage_id);
            if ($garage) {
                $cig->car_id = $garage->maintenance->car_id;
            }
        }

        return view('cig.create', compact('cig', 'cars', 'garages', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCigRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCigRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Calcola IVA se non specificata
            if (isset($data['taxable']) && !isset($data['vat'])) {
                $data['vat'] = $data['taxable'] * 0.22; // IVA 22%
            }

            Cig::create($data);

            $redirectRoute = $request->input('redirect_to_garage')
                ? route('maintenance-garages.show', $request->maintenance_garage_id)
                : route('cigs.index');

            return Redirect::to($redirectRoute)
                ->with('success', 'CIG registrato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nella registrazione del CIG.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Cig $cig
     * @return View
     */
    public function show(Cig $cig): View
    {
        $cig->load([
            'car.carPlates',
            'car.carBrand',
            'maintenanceGarage.maintenance',
            'userRup',
            'userSupport',
            'userTenderNotice',
            'userTester'
        ]);

        return view('cig.show', compact('cig'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cig $cig
     * @return View
     */
    public function edit(Cig $cig): View
    {
        $cars = Car::with(['carPlates', 'carBrand'])->orderBy('model')->get();
        $garages = MaintenanceGarage::with(['maintenance.car'])->orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('cig.edit', compact('cig', 'cars', 'garages', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCigRequest $request
     * @param Cig $cig
     * @return RedirectResponse
     */
    public function update(UpdateCigRequest $request, Cig $cig): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Ricalcola IVA se cambia l'imponibile
            if (isset($data['taxable']) && $data['taxable'] != $cig->taxable) {
                $data['vat'] = $data['taxable'] * 0.22; // IVA 22%
            }

            $cig->update($data);

            return Redirect::route('cigs.index')
                ->with('success', 'CIG aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'aggiornamento del CIG.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cig $cig
     * @return RedirectResponse
     */
    public function destroy(Cig $cig): RedirectResponse
    {
        try {
            $cig->delete();

            return Redirect::route('cigs.index')
                ->with('success', 'CIG eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione del CIG.');
        }
    }

    /**
     * Generate CIG code
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateCig(Request $request)
    {
        // Formato CIG simulato (nella realtà viene dall'ANAC)
        // Z + 2 caratteri casuali + 5 numeri casuali
        $prefix = 'Z';
        $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2));
        $numbers = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);

        $cig = $prefix . $letters . $numbers;

        // Verifica che non esista già
        while (Cig::where('cig', $cig)->exists()) {
            $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2));
            $numbers = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
            $cig = $prefix . $letters . $numbers;
        }

        return response()->json(['cig' => $cig]);
    }

    /**
     * Get CIG statistics
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $stats = [
            'total_cigs' => Cig::whereYear('date', $year)->count(),
            'total_taxable' => Cig::whereYear('date', $year)->sum('taxable'),
            'total_vat' => Cig::whereYear('date', $year)->sum('vat'),
            'total_amount' => Cig::whereYear('date', $year)
                ->selectRaw('SUM(taxable + vat) as total')
                ->value('total'),
            'by_month' => Cig::whereYear('date', $year)
                ->selectRaw('MONTH(date) as month, COUNT(*) as count, SUM(taxable + vat) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'by_garage' => Cig::whereYear('date', $year)
                ->join('maintenance_garages', 'cigs.maintenance_garage_id', '=', 'maintenance_garages.id')
                ->selectRaw('maintenance_garages.name, COUNT(*) as count, SUM(taxable + vat) as total')
                ->groupBy('maintenance_garages.id', 'maintenance_garages.name')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get()
        ];

        return response()->json($stats);
    }

    /**
     * Export CIGs to CSV
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export(Request $request)
    {
        $query = Cig::with([
            'car',
            'maintenanceGarage',
            'userRup',
            'userSupport',
            'userTenderNotice',
            'userTester'
        ]);

        // Applica gli stessi filtri dell'index
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }
        if ($request->filled('maintenance_garage_id')) {
            $query->where('maintenance_garage_id', $request->maintenance_garage_id);
        }
        if ($request->filled('year')) {
            $query->whereYear('date', $request->year);
        }

        $cigs = $query->orderBy('date', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="cig_export_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($cigs) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, [
                'CIG',
                'Data',
                'Veicolo',
                'Targa',
                'Officina',
                'CE',
                'Descrizione',
                'Imponibile',
                'IVA',
                'Totale',
                'RUP',
                'Supporto RUP',
                'Resp. Bando',
                'Collaudatore',
                'Note'
            ]);

            // Dati
            foreach ($cigs as $cig) {
                fputcsv($file, [
                    $cig->cig,
                    $cig->date ? $cig->date->format('d/m/Y') : '',
                    $cig->car ? $cig->car->name : '',
                    $cig->car && $cig->car->carPlates->count() > 0 ? $cig->car->carPlates->first()->name : '',
                    $cig->maintenanceGarage ? $cig->maintenanceGarage->name : '',
                    $cig->ce,
                    $cig->description,
                    number_format($cig->taxable, 2, ',', '.'),
                    number_format($cig->vat, 2, ',', '.'),
                    number_format($cig->taxable + $cig->vat, 2, ',', '.'),
                    $cig->userRup ? $cig->userRup->name : '',
                    $cig->userSupport ? $cig->userSupport->name : '',
                    $cig->userTenderNotice ? $cig->userTenderNotice->name : '',
                    $cig->userTester ? $cig->userTester->name : '',
                    $cig->note
                ]);
            }

            fclose($file);
        }, 200, $headers);
    }
}
