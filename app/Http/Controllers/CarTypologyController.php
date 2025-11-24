<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarTypologyRequest;
use App\Models\CarTypology;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarTypologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carTypologies = CarTypology::with([
            'cars'
        ])->paginate();
        confirmDelete('Cancella Tipologia vettura!', "Sei sicuro di voler cancellare questa tipologia di vettura?");

        return view('car-typology.index', compact('carTypologies'))
            ->with('i', ($request->input('page', 1) - 1) * $carTypologies->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carTypology = new CarTypology();

        return view('car-typology.create', compact('carTypology'));
    }

    public function getForm(): View
    {
        $carTypology = new CarTypology();
        $button = false;
        return view('car-typology.form', compact('carTypology', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(CarTypologyRequest $request): jsonResponse
    {
        $carTypology = CarTypology::create($request->validated());
        return $this->sendResponse($carTypology, 'Tipo alimentazione creato.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarTypologyRequest $request): RedirectResponse
    {
        CarTypology::create($request->validated());

        return Redirect::route('car-typology.index')
            ->with('success', 'Nuova tipologia creata.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarTypology $carTypology): View
    {
        $carTypology->load('cars');

        return view('car-typology.show', compact('carTypology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarTypology $carTypology): View
    {
        $button = true;

        return view('car-typology.edit', compact('carTypology', 'button'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarTypologyRequest $request, CarTypology $carTypology): RedirectResponse
    {
        $carTypology->update($request->validated());

        return Redirect::route('car-typology.index')
            ->with('success', 'Tipologia aggiornata');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarTypology $carTypology): RedirectResponse
    {
        $carTypology->delete();

        return Redirect::route('car-typology.index')
            ->with('success', 'Tipologia cancellata');
    }
}
