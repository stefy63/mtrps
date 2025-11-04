<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\PlateService
 */
class PlateService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\PlateService::class;
    }
}
