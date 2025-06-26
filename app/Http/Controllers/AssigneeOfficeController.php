<?php

namespace App\Http\Controllers;

use App\Models\AssigneeOffice;
use App\Models\CarAssignee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssigneeOfficeRequest;
use App\Http\Requests\UpdateAssigneeOfficeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AssigneeOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $assigneeOffices = AssigneeOffice::with([
            'carAssignee',
            'carAssignee.car',
            'carAssignee.car.carPlates' => function($query) {
                $query->whereNull('date_to')
                      ->orWhere('date_to', '>=', now())
                      ->orderBy('date_from', 'desc');
            }
        ])->paginate();

        confirmDelete('Conferma cancellazione', 'Sei sicuro di voler cancellare questo ufficio?');

        return view('assignee-office.index', compact('assigneeOffices'))
            ->with('i', ($request->input('page', 1) - 1) * $assigneeOffices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $assigneeOffice = new AssigneeOffice();
        $carAssignees = CarAssignee::with(['car', 'car.carPlates' => function($query) {
            $query->whereNull('date_to')
            ->orWhere('date_to', '>=', now())
            ->orderBy('date_from', 'desc');
        }])->get();

        return view('assignee-office.create', compact('assigneeOffice', 'carAssignees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAssigneeOfficeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAssigneeOfficeRequest $request): RedirectResponse
    {
        try {
            AssigneeOffice::create($request->validated());

            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'Ufficio assegnatario creato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore nella creazione dell\'ufficio: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param AssigneeOffice $assigneeOffice
     * @return View
     */
    public function show(AssigneeOffice $assigneeOffice): View
    {
        $assigneeOffice->load([
            'carAssignee',
            'carAssignee.car',
            'carAssignee.car.carPlates' => function($query) {
                $query->whereNull('date_to')
                      ->orWhere('date_to', '>=', now())
                      ->orderBy('date_from', 'desc');
            },
            'carAssignee.car.carType',
            'carAssignee.car.carBrand',
            'carAssignee.car.carOwner'
        ]);

        return view('assignee-office.show', compact('assigneeOffice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AssigneeOffice $assigneeOffice
     * @return View
     */
    public function edit(AssigneeOffice $assigneeOffice): View
    {
        $carAssignees = CarAssignee::with(['car', 'car.carPlates' => function($query) {
            $query->whereNull('date_to')
                  ->orWhere('date_to', '>=', now())
                  ->orderBy('date_from', 'desc');
        }])->get();

        return view('assignee-office.edit', compact('assigneeOffice', 'carAssignees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAssigneeOfficeRequest $request
     * @param AssigneeOffice $assigneeOffice
     * @return RedirectResponse
     */
    public function update(UpdateAssigneeOfficeRequest $request, AssigneeOffice $assigneeOffice): RedirectResponse
    {
        try {
            $assigneeOffice->update($request->validated());

            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'Ufficio assegnatario aggiornato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore nell\'aggiornamento dell\'ufficio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AssigneeOffice $assigneeOffice
     * @return RedirectResponse
     */
    public function destroy(AssigneeOffice $assigneeOffice): RedirectResponse
    {
        try {
            $assigneeOffice->delete();

            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'Ufficio assegnatario eliminato con successo.');
        } catch (\Throwable $e) {
            return Redirect::back()
                ->with('toast_error', 'Errore nell\'eliminazione dell\'ufficio: ' . $e->getMessage());
        }
    }
}
