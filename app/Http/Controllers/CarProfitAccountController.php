<?php

namespace App\Http\Controllers;

use App\Models\CarProfitAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarProfitAccountRequest;
use App\Http\Requests\StoreCarProfitAccountRequest;
use App\Http\Requests\UpdateCarProfitAccountRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarProfitAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $carProfitAccounts = CarProfitAccount::paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
        return view('car-profit-account.index', compact('carProfitAccounts'))
            ->with('i', ($request->input('page', 1) - 1) * $carProfitAccounts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $carProfitAccount = new CarProfitAccount();

        return view('car-profit-account.create', compact('carProfitAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarProfitAccountRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCarProfitAccountRequest $request): RedirectResponse
    {
        try {
            if ($request->validated()) {
                CarProfitAccount::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('car-profit-accounts.index')
                ->with('toast_success', 'CarProfitAccount created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarProfitAccount Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CarProfitAccount $carProfitAccount
     * @return View
     */
    public function show(CarProfitAccount $carProfitAccount): View
    {
        return view('car-profit-account.show', compact('carProfitAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarProfitAccount $carProfitAccount
     * @return View
     */
    public function edit(CarProfitAccount $carProfitAccount): View
    {
        return view('car-profit-account.edit', compact('carProfitAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarProfitAccountRequest $request
     * @param CarProfitAccount $carProfitAccount
     * @return RedirectResponse
     */
    public function update(UpdateCarProfitAccountRequest $request, CarProfitAccount $carProfitAccount): RedirectResponse
    {
        try {
            if ($request->validated()) {
                $carProfitAccount->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('car-profit-accounts.index')
                ->with('toast_success', 'CarProfitAccount updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'CarProfitAccount Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param CarProfitAccount $carProfitAccount
     * @return RedirectResponse
     */
    public function destroy(CarProfitAccount $carProfitAccount): RedirectResponse
    {
        try {
            $carProfitAccount->delete();

            return Redirect::route('car-profit-accounts.index')
                ->with('toast_success', 'CarProfitAccount deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'CarProfitAccount Not deleted');
        }
    }
}
