<?php

namespace App\Http\Controllers;

use App\Models\AssigneeOffice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AssigneeOfficeRequest;
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
        $assigneeOffices = AssigneeOffice::with(['carAssignee'])->paginate();

        confirmDelete('Conferma cancellazione','Sei sicuro di voler cancellare?');
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

        return view('assignee-office.create', compact('assigneeOffice'));
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
            if ($request->validated()) {
                AssigneeOffice::create($request->validated());
            } else {
                Redirect::back()->withErrors();
            }

            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'AssigneeOffice created successfully.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'AssigneeOffice Not created');
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
        return view('assignee-office.edit', compact('assigneeOffice'));
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
            if ($request->validated()) {
                $assigneeOffice->update($request->validated());
            } else {
                Redirect::back()->withErrors();
            }
            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'AssigneeOffice updated successfully');
        } catch (\Throwable $e) {
            return Redirect::back()->with('toast_error', 'AssigneeOffice Not updated');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param AssigneeOffice $assigneeOffice
     * @return RedirectResponse
     */
    public function destroy(AssigneeOffice $assigneeOffice): RedirectResponse
    {
        try {
            $assigneeOffice->delete();

            return Redirect::route('assignee-offices.index')
                ->with('toast_success', 'AssigneeOffice deleted successfully');
        } catch (\Throwable $e) {
            Redirect::back()->with('toast_error', 'AssigneeOffice Not deleted');
        }
    }
}
