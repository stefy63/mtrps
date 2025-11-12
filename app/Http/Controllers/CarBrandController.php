<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarBrandRequest;
use App\Models\CarBrand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carBrands = CarBrand::with('cars');
        $carBrands->when($search = $request->search)->where('name', 'LIKE', "%{$search}%");
        confirmDelete('Cancella Marca Vettura!', "Sei sicuro di voler cancellare questa Marca di Autovettura?");
        $carBrands = $carBrands->paginate();
        return view('car-brand.index', compact('carBrands', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $carBrands->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carBrand = new CarBrand();
        $button = true;

        return view('car-brand.create', compact('carBrand', 'button'));
    }

    public function getForm(): View
    {
        $carBrand = new CarBrand();
        $button = false;
        return view('car-brand.form', compact('carBrand', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(CarBrandRequest $request): JsonResponse
    {
        $carBrand = CarBrand::create($request->validated());
        return $this->sendResponse($carBrand, 'Marca vettura creata con successo.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarBrandRequest $request): RedirectResponse
    {
        CarBrand::create($request->validated());

        return Redirect::route('car-brands.index')
            ->with('success', 'Car Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carBrand = CarBrand::with([
            'cars.carPlates',
            'cars.carType',
        ])->find($id);

        return view('car-brand.show', compact('carBrand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carBrand = CarBrand::find($id);
        $button = true;

        return view('car-brand.edit', compact('carBrand', 'button'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarBrandRequest $request, CarBrand $carBrand): RedirectResponse
    {
        $carBrand->update($request->validated());

        return Redirect::route('car-brands.index')
            ->with('success', 'Car Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarBrand::find($id)->delete();

        return Redirect::route('car-brands.index')
            ->with('success', 'Car Brand deleted successfully');
    }
}