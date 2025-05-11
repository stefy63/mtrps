<?php

namespace App\Http\Requests;

class UpdateCarBrandRequest extends StoreCarBrandRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return  parent::rules();
    }
}
