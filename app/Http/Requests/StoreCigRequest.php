<?php

namespace App\Http\Requests;

class StoreCigRequest extends BaseFormRequest
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
			'maintenance_garage_id' => 'nullable',
			'user_rup_id' => 'nullable',
			'user_support_id' => 'nullable',
			'user_tender_notice_id' => 'nullable',
			'user_tester_id' => 'nullable',
			'date' => 'nullable',
			'ce' => 'nullable|string',
			'description' => 'nullable|string',
			'preventive' => 'nullable|string',
			'final_report' => 'nullable|string',
			'taxable' => 'nullable|string',
			'vat' => 'nullable|string',
			'cig' => 'nullable|string',
			'note' => 'nullable|string',
        ];
    }
}
