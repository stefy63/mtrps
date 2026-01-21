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
            ->whereNull('o.deleted_at')
            ->leftJoin('car_office as co', function($co) use ($date) {
                $co->on('co.office_id', '=', 'o.id')
                    ->where('co.date_from', '<=', $date)
                    ->where(function ($co2) use ($date) {
                        $co2->whereNull('co.date_to')
                        ->orWhere('co.date_to', '>=', $date);
                    });
            })
            ->leftJoin('cars as c', function($c) use ($carTypology) {
                $c->on('co.car_id', '=', 'c.id')
                    ->whereNull('c.deleted_at')
                    ->when($carTypology, fn($q) => $q->whereIn('car_typology_id', $carTypology));
            })
            ->leftJoin('movements as mc', function($mc) use ($date) {
                $mc->on('c.id', '=', 'mc.car_id')
                    ->whereNull('mc.deleted_at')
                    ->where('mc.date_from', '<=', $date)
                    ->where(function ($mc2) use ($date) {
                        $mc2->whereNull('mc.date_to')
                        ->orWhere('mc.date_to', '>=', $date);
                    });
            })
            ->leftJoin('movements as mo', function($mo) use ($date) {
                $mo->on('o.id', '=', 'mo.office_id')
                    ->whereNull('mo.deleted_at')
                    ->where('mo.date_from', '<=', $date)
                    ->where(function ($mo2) use ($date) {
                        $mo2->whereNull('mo.date_to')
                        ->orWhere('mo.date_to', '>=', $date);
                    });
            })
            ->leftJoin('maintenances as ma', function($ma) use ($date) {
                $ma->on('c.id', '=', 'ma.car_id')
                    ->whereNull('ma.deleted_at')
                    ->where('ma.date_from', '<=', $date)
                    ->where(function ($ma2) use ($date) {
                        $ma2->whereNull('ma.date_to')
                        ->orWhere('ma.date_to', '>=', $date);
                    });
            })   

            ->select(
                'o.ente as ente',

                // 🔹 Totale vetture SEMPRE invariato
                DB::raw('COUNT(DISTINCT c.id) as active_cars_count'),

                // 🔹 Vetture prestate SOLO se NON in manutenzione
                DB::raw('COUNT(DISTINCT CASE 
                    WHEN mc.id IS NOT NULL AND ma.id IS NULL THEN mc.id 
                END) as movements_to_count'),

                // 🔹 Vetture in prestito SOLO se NON in manutenzione
                DB::raw('COUNT(DISTINCT CASE 
                    WHEN mo.id IS NOT NULL 
                    AND NOT EXISTS (
                        SELECT 1 
                        FROM maintenances ma2
                        WHERE ma2.car_id = mo.car_id
                        AND ma2.deleted_at IS NULL
                        AND ma2.date_from <= "'.$date.'"
                        AND (ma2.date_to IS NULL OR ma2.date_to >= "'.$date.'")
                    )
                    THEN mo.id 
                END) as movements_from_count'),

                // 🔹 Manutenzioni attive
                DB::raw('COUNT(DISTINCT ma.id) as active_maintenance_count')
            )
            ->groupBy('o.ente');

    }

}
