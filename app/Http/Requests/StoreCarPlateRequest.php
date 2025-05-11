<?php

namespace App\Http\Requests;

class StoreCarPlateRequest extends BaseFormRequest
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
			'name' => 'required|string',
			'type' => 'required',
			'date_from' => 'required',
			'date_to' => 'nullable',
			'note' => 'nullable|string',
        ];
    }
}
