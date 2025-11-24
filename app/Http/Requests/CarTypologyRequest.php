<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class CarTypologyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $car_typology = $this->route('car_typology');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('car_typologies')->ignore($car_typology?->id)->where('deleted_at', null),
            ],
            'description' => ['nullable', 'string'],
        ];
    }

}
