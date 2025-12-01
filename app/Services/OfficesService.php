<?php

namespace App\Services;

use App\Models\Office;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class OfficesService
{
    public function __construct()
    {
    }

    /**
     * @param  string  $ente
     * @param  string|null  $section
     * @return Office|null
     */
    public function getOfficeByName(string $ente, ?string $section): Office|null
    {
        return Office::where('ente', $ente)
            ->when($section, fn($q) => $q->where('name', $section))
            ->first();
    }

    /**
     * @param  int  $id
     * @return Office|null
     */
    public function getOfficeById(int $id = 0): Office|null
    {
        return Office::with('cars')->whereId($id)->first();
    }

    public static function getOfficesWithCars(?array $carTypology = [], ?string $date = null): QueryBuilder
    {
        return DB::table('offices as o')
            ->leftJoin('car_office as co', fn($co) => $co->on('co.office_id', '=', 'o.id')
                    ->where('co.date_from', '<=', $date)
                    ->where(function ($co2) use ($date) {
                        $co2->whereNull('co.date_to')
                        ->orWhere('co.date_to', '>=', $date);
                    })
                )
            ->leftJoin('cars as c', fn($c) => $c->on('co.car_id', '=', 'c.id')
                    ->when($carTypology, fn($q) => $q->whereIn('car_typology_id', $carTypology)) 
                )
            ->leftJoin('movements as mc', fn($mc) => $mc->on('c.id', '=', 'mc.car_id')
                    ->where('mc.date_from', '<=', $date)
                    ->where(function ($mc2) use ($date) {
                        $mc2->whereNull('mc.date_to')
                        ->orWhere('mc.date_to', '>=', $date);
                    })
                )
            ->leftJoin('movements as mo', fn($mo) => $mo->on('o.id', '=', 'mo.office_id')
                    ->where('mo.date_from', '<=', $date)
                    ->where(function ($mo2) use ($date) {
                        $mo2->whereNull('mo.date_to')
                        ->orWhere('mo.date_to', '>=', $date);
                    })
                )
            ->leftJoin('cars as ca', fn($ca) => $ca->on('ca.id', '=', 'mo.car_id')
                ->when($carTypology, fn($ca) => $ca->whereIn('ca.car_typology_id', $carTypology))
            )
            ->leftJoin('maintenances as ma', fn($ma) => $ma->on('c.id', '=', 'ma.car_id')
                    ->where('ma.date_from', '<=', $date)
                    ->where(function ($ma2) use ($date) {
                        $ma2->whereNull('ma.date_to')
                        ->orWhere('ma.date_to', '>=', $date);
                    })
                )

            ->select(
                'o.ente as ente',
                DB::raw('COUNT(DISTINCT c.id) as active_cars_count'),
                DB::raw('COUNT(DISTINCT mc.id) as movements_to_count'),
                DB::raw('COUNT(DISTINCT mo.id) as movements_from_count'),
                DB::raw('COUNT(DISTINCT ma.id) as active_maintenance_count'),
            )
            ->groupBy('o.ente');

    }

}
