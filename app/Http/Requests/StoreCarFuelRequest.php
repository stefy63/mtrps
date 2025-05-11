<?php

namespace App\Http\Requests;

class StoreCarFuelRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
			'car_id' => 'nullable',
			'user_id' => 'nullable',
			'name' => 'required|string',
			'description' => 'nullable|string',
			'date_from' => 'required',
			'date_to' => 'nullable',
			'note' => 'nullable|string',
        ];
    }
}
