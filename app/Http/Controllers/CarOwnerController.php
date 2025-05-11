<?php

namespace App\Http\Controllers;

use App\Models\CarOwner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarOwnerRequest;
use App\Http\Requests\StoreCarOwnerRequest;
use App\Http\Requests\UpdateCarOwnerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carOwners = CarOwner::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-owner.index', compact('carOwners'))
            ->with('i', ($request->input('page', 1) - 1) * $carOwners->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carOwner = new CarOwner();

        return view('car-owner.create', compact('carOwner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarOwnerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarOwnerRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarOwner::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-owners.index')
                ->with('toast_success', 'CarOwner created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarOwner Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarOwner $carOwner
     * @return View
     */
    public function show(CarOwner $carOwner): View
    {
        return view('car-owner.show', compact('carOwner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarOwner $carOwner
     * @return View
     */
    public function edit(CarOwner $carOwner): View
    {
        return view('car-owner.edit', compact('carOwner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarOwnerRequest $request
     * @param CarOwner $carOwner
     * @return RedirectResponse
     */
    public function update(UpdateCarOwnerRequest $request, CarOwner $carOwner): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carOwner->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-owners.index')
                ->with('toast_success', 'CarOwner updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarOwner Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarOwner $carOwner
     * @return RedirectResponse
     */
    public function destroy(CarOwner $carOwner): RedirectResponse
    {
        try {
            $carOwner->delete();

            return Redirect::route('car-owners.index')
                ->with('toast_success', 'CarOwner deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarOwner Not deleted');
        }
    }
}
