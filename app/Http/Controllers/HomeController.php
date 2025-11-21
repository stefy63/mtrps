<?php

namespace App\Http\Controllers;

use App\Models\Office;
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
    public function index()
    {
        $typology = '(Auto Civili)';
        $data = Office::query()
            ->select('ente')
            ->whereIn('id', function ($q) {
                $q->select(DB::raw('MIN(id)'))
                    ->from('offices')
                    ->groupBy('ente');
            })
            ->withCount([
                'activeCars',
                'movementsTo',
                'movementsFrom',
                'activeMaintenance'
            ])
            ->orderByDesc(DB::raw('
                (active_cars_count + movements_from_count) - (active_maintenance_count + movements_to_count)
            '))
            ->get();

        return view('home', compact('data'));
    }
}
