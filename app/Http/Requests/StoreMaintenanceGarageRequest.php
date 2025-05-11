<?php

namespace App\Http\Requests;

class StoreMaintenanceGarageRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
			'maintenance_id' => 'nullable',
			'name' => 'required|string',
			'piva' => 'nullable',
			'cf' => 'nullable|string',
			'iban' => 'nullable|string',
			'pec' => 'nullable|string',
			'acc' => 'required',
			'anti_mafia' => 'required',
			'durc' => 'nullable',
			'description' => 'nullable|string',
			'note' => 'nullable|string',
        ];
    }
}
