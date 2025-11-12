<?php

namespace App\Http\Controllers;

use App\Models\CarProfitAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarProfitAccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarProfitAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = CarProfitAccount::with(['creator', 'updater']);

        // Ricerca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('responsible', 'like', "%{$search}%");
            });
        }

        // Filtro categoria
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filtro stato
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->valid();
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
                case 'expired':
                    $query->where('is_active', true)
                        ->where('valid_to', '<', now());
                    break;
            }
        }

        // Ordinamento
        $sortField = $request->get('sort', 'code');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $carProfitAccounts = $query->paginate();

        // Aggiungi conteggio veicoli per ogni account
        $carProfitAccounts->each(function ($account) {
            $account->cars_count = $account->cars()->count();
            $account->active_cars_count = $account->getActiveCarsCountAttribute();
        });

        // Statistiche
        $stats = [
            'total' => CarProfitAccount::count(),
            'active' => CarProfitAccount::count(),
            'with_cars' => CarProfitAccount::has('cars')->count(),
            'expiring_soon' => null,
        ];


        $categories = CarProfitAccount::CATEGORIES;

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo centro di costo?');

        return view('car-profit-account.index', compact(
            'carProfitAccounts',
            'stats',
            'categories'
        ))->with('i', ($request->input('page', 1) - 1) * $carProfitAccounts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carProfitAccount = new CarProfitAccount();

        // Genera codice suggerito
        $carProfitAccount->code = CarProfitAccount::generateNextCode();

        // Imposta date di default
        $carProfitAccount->valid_from = now();
        $carProfitAccount->is_active = true;

        $categories = CarProfitAccount::CATEGORIES;

        // Suggerimenti per dipartimenti basati su PA
        $suggestedDepartments = [
            'Direzione Generale',
            'Ufficio Tecnico',
            'Servizi Amministrativi',
            'Polizia Locale',
            'Protezione Civile',
            'Servizi Sociali',
            'Urbanistica',
            'Ambiente',
            'Cultura e Sport',
            'Economato',
        ];

        return view('car-profit-account.create', compact(
            'carProfitAccount',
            'categories',
            'suggestedDepartments'
        ));
    }

    public function getForm(): View
    {
        $carProfitAccount = new CarProfitAccount();
        $categories = CarProfitAccount::CATEGORIES;
        $button = false;
        return view('car-profit-account.form', compact(
            'carProfitAccount',
            'categories',
            'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(CarProfitAccountRequest $request): JsonResponse
    {
        $carProfitAccount = CarProfitAccount::create($request->validated());
        return $this->sendResponse($carProfitAccount, 'Tipo vettura creata.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarProfitAccountRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['created_by'] = Auth::id();

            CarProfitAccount::create($data);

            return Redirect::route('car-profit-accounts.index')
                ->with('success', 'Centro di costo creato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante la creazione: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarProfitAccount $carProfitAccount): View
    {
        // Carica relazioni
        $carProfitAccount->load(['cars.carPlates', 'creator', 'updater']);

        // Statistiche utilizzo
        $usageStats = [
            'total_cars' => $carProfitAccount->cars->count(),
            'active_cars' => $carProfitAccount->active_cars_count,
            'budget_usage' => $carProfitAccount->budget_usage_percentage,
            'remaining_budget' => $carProfitAccount->remaining_budget_year,
        ];

        // Veicoli associati con info aggiuntive
        $cars = $carProfitAccount->cars()
            ->with(['carPlates', 'carType', 'carBrand'])
            ->get();

        return view('car-profit-account.show', compact(
            'carProfitAccount',
            'usageStats',
            'cars'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarProfitAccount $carProfitAccount): View
    {
        $categories = CarProfitAccount::CATEGORIES;

        // Suggerimenti per dipartimenti
        $suggestedDepartments = [
            'Direzione Generale',
            'Ufficio Tecnico',
            'Servizi Amministrativi',
            'Polizia Locale',
            'Protezione Civile',
            'Servizi Sociali',
            'Urbanistica',
            'Ambiente',
            'Cultura e Sport',
            'Economato',
        ];

        return view('car-profit-account.edit', compact(
            'carProfitAccount',
            'categories',
            'suggestedDepartments'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarProfitAccountRequest $request, CarProfitAccount $carProfitAccount): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['updated_by'] = Auth::id();

            $carProfitAccount->update($data);

            return Redirect::route('car-profit-accounts.index')
                ->with('success', 'Centro di costo aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore durante l\'aggiornamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarProfitAccount $carProfitAccount): RedirectResponse
    {
        try {
            // Verifica se ci sono veicoli associati
            if ($carProfitAccount->cars()->exists()) {
                return Redirect::back()
                    ->with('toast_error', 'Impossibile eliminare: ci sono veicoli associati a questo centro di costo.');
            }

            $carProfitAccount->delete();

            return Redirect::route('car-profit-accounts.index')
                ->with('success', 'Centro di costo eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore durante l\'eliminazione.');
        }
    }

    /**
     * Toggle active status
     */
    public function toggleActive(CarProfitAccount $carProfitAccount): RedirectResponse
    {
        try {
            $carProfitAccount->update([
                'is_active' => !$carProfitAccount->is_active,
                'updated_by' => Auth::id()
            ]);

            $status = $carProfitAccount->is_active ? 'attivato' : 'disattivato';

            return Redirect::back()
                ->with('success', "Centro di costo {$status} con successo.");
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore durante l\'aggiornamento dello stato.');
        }
    }

    /**
     * Export to CSV
     */
    public function export()
    {
        $accounts = CarProfitAccount::with('cars')
            ->orderBy('code')
            ->get();

        $csvData = "Codice,Nome,Categoria,Dipartimento,Responsabile,Email,Telefono,Budget Anno,Stato,Veicoli\n";

        foreach ($accounts as $account) {
            $csvData .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s,%s,%s,%d\n",
                $account->code,
                $account->name,
                $account->category_label,
                $account->department ?? '',
                $account->responsible ?? '',
                $account->email ?? '',
                $account->phone ?? '',
                $account->budget_year ?? '',
                $account->status_label,
                $account->cars_count
            );
        }

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="centri_di_costo_' . date('Y-m-d') . '.csv"');
    }
}
