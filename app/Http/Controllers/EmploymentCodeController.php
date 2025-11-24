<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarEmploymentCodeRequest;
use App\Models\CarEmploymentCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmploymentCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = CarEmploymentCode::with('cars');

        // Filtri
        if ($search = $request->search) {
            $query = $query->where('extended', 'LIKE', "%{$search}%");
        }
        confirmDelete('Cancella codice d\'impiego!', 'Sei sicuro di voler cancellare questo codice d\'impiego?');
        $carEmploymentCode = $query->paginate();
        return view('employment-code.index', compact('carEmploymentCode', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $carEmploymentCode->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carEmploymentCode = new CarEmploymentCode();

        return view('employment-code.create', compact('carEmploymentCode'));
    }

    public function getForm(): View
    {
        $carEmploymentCode = new CarEmploymentCode();
        $button = false;
        return view('employment-code.form', compact('carEmploymentCode', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(StoreCarEmploymentCodeRequest $request): JsonResponse
    {
        $carEmploymentCode = CarEmploymentCode::create($request->validated());
        return $this->sendResponse($carEmploymentCode, 'Codice d\'impiego creato.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarEmploymentCodeRequest $request): RedirectResponse
    {
        CarEmploymentCode::create($request->validated());

        return Redirect::route('employment-code.index')
            ->with('success', 'Codice d\'impiego creato.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carEmploymentCode = CarEmploymentCode::find($id);

        return view('employment-code.show', compact('carEmploymentCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarEmploymentCode $employmentCode): View
    {
        $carEmploymentCode = $employmentCode;
        return view('employment-code.edit', compact('carEmploymentCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCarEmploymentCodeRequest $request, CarEmploymentCode $employmentCode): RedirectResponse
    {
        $employmentCode->update($request->validated());

        return Redirect::route('employment-code.index')
            ->with('success', 'Codice d\'impiego aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        CarEmploymentCode::find($id)->delete();

        return Redirect::route('employment-code.index')
            ->with('success', 'Codice d\'impiego cancellato');
    }

}
