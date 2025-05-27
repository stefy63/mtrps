<?php

namespace App\Http\Controllers;

use App\Models\CarAssignee;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarAssigneeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarAssigneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carAssignees = CarAssignee::with([
            'car', 
            'car.carBrand', 
            'car.carType', 
            'car.carOwner',
            'car.carPlates',
            'assigneeOffices'
        ])->paginate();

        return view('car-assignee.index', compact('carAssignees'))
            ->with('i', ($request->input('page', 1) - 1) * $carAssignees->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carAssignee = new CarAssignee();
        
        // Recupera i veicoli disponibili
        $cars = Car::with('carBrand', 'carType', 'carPlates')->get()->pluck('full_name_with_details', 'id');
        
        return view('car-assignee.create', compact('carAssignee', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarAssigneeRequest $request): RedirectResponse
    {
        CarAssignee::create($request->validated());

        return Redirect::route('car-assignees.index')
            ->with('success', 'Car Assignee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carAssignee = CarAssignee::with([
            'car', 
            'car.carBrand', 
            'car.carType', 
            'car.carOwner',
            'car.carPlates',
            'assigneeOffices'
        ])->find($id);

        return view('car-assignee.show', compact('carAssignee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carAssignee = CarAssignee::find($id);
        
        // Recupera i veicoli disponibili
        $cars = Car::with('carBrand', 'carType', 'carPlates')->get()->pluck('full_name_with_details', 'id');

        return view('car-assignee.edit', compact('carAssignee', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarAssigneeRequest $request, CarAssignee $carAssignee): RedirectResponse
    {
        $carAssignee->update($request->validated());

        return Redirect::route('car-assignees.index')
            ->with('success', 'Car Assignee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarAssignee::find($id)->delete();

        return Redirect::route('car-assignees.index')
            ->with('success', 'Car Assignee deleted successfully');
    }

    /**
     * Get current assignees (active assignments)
     */
    public function current(Request $request): View
    {
        $carAssignees = CarAssignee::current()->with([
            'car', 
            'car.carBrand', 
            'car.carType', 
            'car.carOwner',
            'car.carPlates',
            'assigneeOffices'
        ])->paginate();

        return view('car-assignee.current', compact('carAssignees'))
            ->with('i', ($request->input('page', 1) - 1) * $carAssignees->perPage());
    }

    /**
     * Get assignees by vehicle for AJAX
     */
    public function getByVehicle($carId)
    {
        $assignees = CarAssignee::where('car_id', $carId)
            ->with('assigneeOffices')
            ->get();
        return response()->json($assignees);
    }

    /**
     * Get assignment history for a vehicle
     */
    public function vehicleHistory($carId): View
    {
        $car = Car::with('carBrand', 'carType')->find($carId);
        $assignees = CarAssignee::where('car_id', $carId)
            ->with('assigneeOffices')
            ->orderBy('date_from', 'desc')
            ->get();

        return view('car-assignee.vehicle-history', compact('car', 'assignees'));
    }
}