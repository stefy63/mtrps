<?php

namespace App\Http\Controllers;

use App\Models\CarAssignee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarAssigneeRequest;
use App\Http\Requests\StoreCarAssigneeRequest;
use App\Http\Requests\UpdateCarAssigneeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarAssigneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carAssignees = CarAssignee::with(['car', 'car.carPlates'])->paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-assignee.index', compact('carAssignees'))
            ->with('i', ($request->input('page', 1) - 1) * $carAssignees->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carAssignee = new CarAssignee();

        return view('car-assignee.create', compact('carAssignee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarAssigneeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarAssigneeRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarAssignee::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-assignees.index')
                ->with('toast_success', 'CarAssignee created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarAssignee Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarAssignee $carAssignee
     * @return View
     */
    public function show(CarAssignee $carAssignee): View
    {
        return view('car-assignee.show', compact('carAssignee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarAssignee $carAssignee
     * @return View
     */
    public function edit(CarAssignee $carAssignee): View
    {
        return view('car-assignee.edit', compact('carAssignee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarAssigneeRequest $request
     * @param CarAssignee $carAssignee
     * @return RedirectResponse
     */
    public function update(UpdateCarAssigneeRequest $request, CarAssignee $carAssignee): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carAssignee->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-assignees.index')
                ->with('toast_success', 'CarAssignee updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarAssignee Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarAssignee $carAssignee
     * @return RedirectResponse
     */
    public function destroy(CarAssignee $carAssignee): RedirectResponse
    {
        try {
            $carAssignee->delete();

            return Redirect::route('car-assignees.index')
                ->with('toast_success', 'CarAssignee deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarAssignee Not deleted');
        }
    }
}
