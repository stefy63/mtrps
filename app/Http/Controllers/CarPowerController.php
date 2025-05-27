<?php

namespace App\Http\Controllers;

use App\Models\CarPower;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarPowerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarPowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carPowers = CarPower::paginate();

        return view('car-power.index', compact('carPowers'))
            ->with('i', ($request->input('page', 1) - 1) * $carPowers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carPower = new CarPower();

        return view('car-power.create', compact('carPower'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarPowerRequest $request): RedirectResponse
    {
        CarPower::create($request->validated());

        return Redirect::route('car-powers.index')
            ->with('success', 'Car Power created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carPower = CarPower::find($id);

        return view('car-power.show', compact('carPower'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carPower = CarPower::find($id);

        return view('car-power.edit', compact('carPower'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarPowerRequest $request, CarPower $carPower): RedirectResponse
    {
        $carPower->update($request->validated());

        return Redirect::route('car-powers.index')
            ->with('success', 'Car Power updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarPower::find($id)->delete();

        return Redirect::route('car-powers.index')
            ->with('success', 'Car Power deleted successfully');
    }
}