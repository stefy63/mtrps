<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;

trait Utils
{


    /**
     * Pulisce un valore CSV: trim, converti encoding, stringhe vuote → null.
     */
    protected function cleanValue($val, $camelcase = false): string|null
    {
        if (is_null($val)) {
            return null;
        }

        // Assicurati che sia UTF-8
        $val = trim($val);
        // Se vuoi, puoi forzare a utf8
        $val = mb_convert_encoding($val, 'UTF-8', 'ISO-8859-1');
        if ($camelcase) {
            // Se vuoi il camelcase
            $val = str_replace([' ', '.'], ['',''], ucwords(strtolower($val)));
        }

        // Se la stringa è vuota, trasformala in null
        return ($val === '') ? null : $val;
    }


    private function firstOrCreate(Model $model, string $fieldName, string $fieldValue, array $extraFields = []): Model|null
    {
        return $model::firstOrCreate([$fieldName => mb_trim($fieldValue)], $extraFields);
    }

    private function findOrNew(Model $model, string $fieldName, string $fieldValue, array $extraFields = []): Model|null
    {
        return $model::findOrNew([$fieldName => mb_trim($fieldValue)], $extraFields);
    }
}