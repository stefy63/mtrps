<?php

namespace App\Http\Controllers;

use App\Facades\OfficesService;
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

        $data = OfficesService::getOfficesWithCars($carTypology, $date);

        $typology = CarTypology::all()->pluck('name', 'id')->toArray();
        // Filtri
        if ($search = $request->search) {
            $data = $data->where('ente', 'like', "%{$search}%");
        }
        $data = $data->get();

// dd($data->toArray(), $date);
        return view('home', compact('data', 'search', 'date', 'carTypology', 'typology'));
    }
}
