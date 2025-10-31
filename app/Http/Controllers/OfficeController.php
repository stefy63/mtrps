<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->search;
        $offices = Office::when($search, function ($q) use ($search) {
            return $q->where('ente', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('mail', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%");
        })->paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('office.index', compact('offices', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $offices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $office = new Office();

        return view('office.create', compact('office'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOfficeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOfficeRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                Office::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('offices.index')
                ->with('toast_success', 'Ufficio creato.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Office Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Office $office
     * @return View
     */
    public function show(Office $office): View
    {
        return view('office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Office $office
     * @return View
     */
    public function edit(Office $office): View
    {
        return view('office.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOfficeRequest $request
     * @param Office $office
     * @return RedirectResponse
     */
    public function update(UpdateOfficeRequest $request, Office $office): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $office->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('offices.index')
                ->with('toast_success', 'Ufficio Aggiornato');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Office Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Office $office
     * @return RedirectResponse
     */
    public function destroy(Office $office): RedirectResponse
    {
        try {
            $office->delete();

            return Redirect::route('offices.index')
                ->with('toast_success', 'Office deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Office Not deleted');
        }
    }
}
