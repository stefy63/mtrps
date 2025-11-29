<?php

namespace App\Http\Controllers;

use App\Models\CarTypology;
use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($date = $request->date) {
            $date = Carbon::parse($date)->format('Y-m-d H:i');
        } else {
            $date = now()->format('Y-m-d H:i');
        }
        $carTypology = $request->carTypology ?? null;
        $data = Office::query()
            ->select(
                'id', 
                'ente',
                )
            ->whereIn('id', function ($q) {
                    $q->select(DB::raw('MIN(id)'))
                    ->from('offices')
                    ->groupBy('ente');
            })
            ->withCount([
                'activeCars' => function ($q) use ($carTypology) {
                    $q->when($carTypology, fn($q) => $q->whereIn('car_typology_id', $carTypology));
                },
                'movementsTo' => function ($q) use ($date, $carTypology) {
                    $q->when($carTypology, fn($q) => $q->whereIn('car_typology_id', $carTypology));
                    $q->when($date, fn($q) => $q->with('movements', fn($q) => $q->withoutGlobalScope('inprogress')->whereNull('date_to')->orWhereRaw('? BETWEEN date_from AND date_to', [$date])));
                },
                'movementsFrom' => function ($q) use ($date, $carTypology) {
                    $q->when($carTypology, fn($q) => $q->with('car', fn($q) => $q->whereIn('car_typology_id', $carTypology)));
                    $q->when($date, fn($q) => $q->whereNull('date_to')->orWhereRaw('? BETWEEN date_from AND date_to', [$date]));
                },
                'activeMaintenance' => function ($q) use ($carTypology) {
                    $q->when($carTypology, fn($q) => $q->whereIn('car_typology_id', $carTypology));
                }
            ])
            ->orderBy('ente');

            $typology = CarTypology::all()->pluck('name', 'id')->toArray();
        // Filtri
        if ($search = $request->search) {
            $data = $data->where('ente', 'like', "%{$search}%");
        }

        $data = $data->get();
// dd($data->toArray());
        return view('home', compact('data', 'search', 'date', 'carTypology', 'typology'));
    }
}
