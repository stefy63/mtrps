<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterCarService
 * @package App\Services
 */
class FilterCarService
{
    /**
     * @param  Builder  $query
     * @param  string  $search
     * @return mixed
     */
    public static function getCarWithFilter(Builder $query, string $search, string $car = 'car'): Builder
    {
        return $query->orWhereHas($car, function ($q) use ($search) {
            self::getRelationWithFilter($q, $search);
        });
    }

    public static function getRelationWithFilter(Builder $query, string $search): Builder
    {
        return $query->where('chassis', 'LIKE', "%{$search}%")
            ->orWhereHas('carBrand', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('carType', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('carPlates', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            })->orWhereHas('carOffices', function ($q) use ($search) {
                $q->where('ente', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })->orWhereHas('carOwner', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('carEquipment', function ($q) use ($search) {
                $q->where('car_equipment.note', 'like', "%{$search}%");
            })->orWhereHas('carTypology', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
    }
}
