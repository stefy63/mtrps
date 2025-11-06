<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\MovementService
 */
class MovementService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\MovementService::class;
    }
}
