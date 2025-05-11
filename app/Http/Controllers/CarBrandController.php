<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarBrandRequest;
use App\Http\Requests\StoreCarBrandRequest;
use App\Http\Requests\UpdateCarBrandRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carBrands = CarBrand::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-brand.index', compact('carBrands'))
            ->with('i', ($request->input('page', 1) - 1) * $carBrands->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carBrand = new CarBrand();

        return view('car-brand.create', compact('carBrand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarBrandRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarBrandRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarBrand::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-brands.index')
                ->with('toast_success', 'CarBrand created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarBrand Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarBrand $carBrand
     * @return View
     */
    public function show(CarBrand $carBrand): View
    {
        return view('car-brand.show', compact('carBrand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarBrand $carBrand
     * @return View
     */
    public function edit(CarBrand $carBrand): View
    {
        return view('car-brand.edit', compact('carBrand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarBrandRequest $request
     * @param CarBrand $carBrand
     * @return RedirectResponse
     */
    public function update(UpdateCarBrandRequest $request, CarBrand $carBrand): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carBrand->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-brands.index')
                ->with('toast_success', 'CarBrand updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarBrand Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarBrand $carBrand
     * @return RedirectResponse
     */
    public function destroy(CarBrand $carBrand): RedirectResponse
    {
        try {
            $carBrand->delete();

            return Redirect::route('car-brands.index')
                ->with('toast_success', 'CarBrand deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarBrand Not deleted');
        }
    }
}
