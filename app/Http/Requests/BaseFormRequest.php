<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class BaseFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }


    protected function resolveRoute(string $placeholder, string $model): Route|null|Model
    {
        $object = $this->route($placeholder);
        if (is_numeric($object)) {
            $object = $model::find($object);
        }
        return $object;
    }
}
