<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCigRequest extends StoreCigRequest
{

    public function rules(): array
    {
        $rules = parent::rules();
        
        $rules['cig'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('cigs', 'cig')->ignore($this->cig, 'cig'),
        ];
        return $rules;
    }
}
