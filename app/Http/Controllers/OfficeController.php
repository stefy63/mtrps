<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Models\Office;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use function Pest\Laravel\get;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->search;
        $query = Office::when($search, function ($q) use ($search) {
            return $q->where('ente', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('mail', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%");
        });

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare?');

        $offices = $query->paginate();
        return view('office.index', compact('offices', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $offices->perPage());
    }


    public function getForm(): View
    {
        $office = new Office();
        $button = false;
        return view('office.form',
            compact('office', 'button'));
    }

    public function storeForm(StoreOfficeRequest $request): JsonResponse
    {
        try {
            if ($data = $request->validated()) {
                $office = Office::create($data);
            }
            return $this->sendResponse($office, 'Ufficio creato con successo.');
        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $office = new Office();

        return view('office.create', compact('office'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOfficeRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreOfficeRequest $request): RedirectResponse
    {
        try {
            if ($data = $request->validated()) {
                Office::create($data);
            }
            return Redirect::route('offices.index')
                ->with('success', 'Ufficio creato.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Ufficio non salvato!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Office  $office
     * @return View
     */
    public function show(Office $office): View
    {
        $office->load([
            'cars.carPlates',
            'cars.carTypology',
            'movementsTo.movements.office',
            'movement',
        ]);
        // dd($office->toArray());
        return view('office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Office  $office
     * @return View
     */
    public function edit(Office $office): View
    {
        return view('office.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOfficeRequest  $request
     * @param  Office  $office
     * @return RedirectResponse
     */
    public function update(UpdateOfficeRequest $request, Office $office): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $office->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('offices.index')
                ->with('success', 'Ufficio Aggiornato');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Office Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  Office  $office
     * @return RedirectResponse
     */
    public function destroy(Office $office): RedirectResponse
    {
        try {
            $office->delete();

            return Redirect::route('offices.index')
                ->with('success', 'Office deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Office Not deleted');
        }
    }
}
