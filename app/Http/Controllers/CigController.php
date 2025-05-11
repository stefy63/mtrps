<?php

namespace App\Http\Controllers;

use App\Models\Cig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CigRequest;
use App\Http\Requests\StoreCigRequest;
use App\Http\Requests\UpdateCigRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $cigs = Cig::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('cig.index', compact('cigs'))
            ->with('i', ($request->input('page', 1) - 1) * $cigs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $cig = new Cig();

        return view('cig.create', compact('cig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCigRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCigRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                Cig::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('cigs.index')
                ->with('toast_success', 'Cig created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Cig Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Cig $cig
     * @return View
     */
    public function show(Cig $cig): View
    {
        return view('cig.show', compact('cig'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cig $cig
     * @return View
     */
    public function edit(Cig $cig): View
    {
        return view('cig.edit', compact('cig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCigRequest $request
     * @param Cig $cig
     * @return RedirectResponse
     */
    public function update(UpdateCigRequest $request, Cig $cig): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $cig->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('cigs.index')
                ->with('toast_success', 'Cig updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'Cig Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Cig $cig
     * @return RedirectResponse
     */
    public function destroy(Cig $cig): RedirectResponse
    {
        try {
            $cig->delete();

            return Redirect::route('cigs.index')
                ->with('toast_success', 'Cig deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'Cig Not deleted');
        }
    }
}
