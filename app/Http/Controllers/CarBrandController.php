<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarBrandRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carBrands = CarBrand::paginate();

        return view('car-brand.index', compact('carBrands'))
            ->with('i', ($request->input('page', 1) - 1) * $carBrands->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carBrand = new CarBrand();

        return view('car-brand.create', compact('carBrand'));
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
        $carBrand = CarBrand::find($id);

        return view('car-brand.show', compact('carBrand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carBrand = CarBrand::find($id);

        return view('car-brand.edit', compact('carBrand'));
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