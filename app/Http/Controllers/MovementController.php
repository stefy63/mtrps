<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovementRequest;
use App\Http\Requests\StoreMovementRequest;
use App\Http\Requests\UpdateMovementRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $movements = Movement::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('movement.index', compact('movements'))
            ->with('i', ($request->input('page', 1) - 1) * $movements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $movement = new Movement();

        return view('movement.create', compact('movement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovementRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMovementRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                Movement::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('movements.index')
                ->with('toast_success', 'Movement created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Movement Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Movement $movement
     * @return View
     */
    public function show(Movement $movement): View
    {
        return view('movement.show', compact('movement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movement $movement
     * @return View
     */
    public function edit(Movement $movement): View
    {
        return view('movement.edit', compact('movement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMovementRequest $request
     * @param Movement $movement
     * @return RedirectResponse
     */
    public function update(UpdateMovementRequest $request, Movement $movement): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $movement->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('movements.index')
                ->with('toast_success', 'Movement updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Movement Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Movement $movement
     * @return RedirectResponse
     */
    public function destroy(Movement $movement): RedirectResponse
    {
        try {
            $movement->delete();

            return Redirect::route('movements.index')
                ->with('toast_success', 'Movement deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Movement Not deleted');
        }
    }
}
