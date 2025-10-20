<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarTypeRequest;
use App\Models\CarType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carTypes = CarType::paginate();

        confirmDelete('Cancella Tipo Vettura!', 'Sei sicuro di voler cancellare questo Tipo?');

        return view('car-type.index', compact('carTypes'))
            ->with('i', ($request->input('page', 1) - 1) * $carTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carType = new CarType();

        return view('car-type.create', compact('carType'));
    }

    public function getForm(): View
    {
        $carType = new CarType();
        $button = false;
        return view('car-type.form', compact('carType', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(CarTypeRequest $request): JsonResponse
    {
        $carType = CarType::create($request->validated());
        return $this->sendResponse($carType, 'Tipo vettura creata.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarTypeRequest $request): RedirectResponse
    {
        CarType::create($request->validated());

        return Redirect::route('car-types.index')
            ->with('success', 'Car Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carType = CarType::find($id);

        return view('car-type.show', compact('carType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carType = CarType::find($id);

        return view('car-type.edit', compact('carType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarTypeRequest $request, CarType $carType): RedirectResponse
    {
        $carType->update($request->validated());

        return Redirect::route('car-types.index')
            ->with('success', 'Car Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarType::find($id)->delete();

        return Redirect::route('car-types.index')
            ->with('success', 'Car Type deleted successfully');
    }
}