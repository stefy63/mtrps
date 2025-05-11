<?php

namespace App\Http\Requests;

class StoreCarRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
			'car_type_id' => 'nullable',
			'car_owner_id' => 'nullable',
			'car_brand_id' => 'nullable',
			'car_power_id' => 'nullable',
			'car_profit_account_id' => 'nullable',
			'name' => 'required|string',
			'model' => 'nullable|string',
			'color' => 'nullable|string',
			'cod_model' => 'nullable|string',
			'profit_account' => 'nullable|string',
			'tank' => 'nullable',
			'km' => 'nullable',
			'description' => 'nullable|string',
			'winter_wheels' => 'required',
			'wheels_type' => 'nullable|string',
			'warranty' => 'nullable|string',
			'tel_warranty' => 'nullable|string',
			'chassis' => 'nullable|string',
			'date_revision' => 'nullable',
			'doc' => 'nullable',
			'note' => 'nullable|string',
        ];
    }
}
