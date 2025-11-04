<?php

namespace App\Services;

use App\Models\Office;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HigherOrderWhenProxy;

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

}
