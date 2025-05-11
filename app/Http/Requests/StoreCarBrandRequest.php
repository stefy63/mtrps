<?php

namespace App\Http\Requests;

class StoreCarBrandRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
			'name' => 'required|string',
			'description' => 'nullable|string',
			'note' => 'nullable|string',
        ];
    }
}
