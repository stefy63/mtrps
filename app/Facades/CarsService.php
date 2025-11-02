<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\CarsService
 */
class CarsService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\CarsService::class;
    }
}
