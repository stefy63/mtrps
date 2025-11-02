<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\OfficesService
 */
class OfficesService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\OfficesService::class;
    }
}
