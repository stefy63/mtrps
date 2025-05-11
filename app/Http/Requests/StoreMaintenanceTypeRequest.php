<?php

namespace App\Http\Requests;

class StoreMaintenanceTypeRequest extends BaseFormRequest
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
			'description' => 'nullable|string',
			'note' => 'nullable|string',
        ];
    }
}
