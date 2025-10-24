<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterOfficeService
 * @package App\Services
 */
class FilterOfficeService
{

    /**
     * @param  Builder  $query
     * @param  string  $search
     * @return mixed
     */
    public static function getOfficeWithFilter(Builder $query, string $search, string $relation = 'office'): Builder
    {
        return $query->orWhereHas($relation, function ($q) use ($search) {
            $q->where('ente', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        });
    }
}
