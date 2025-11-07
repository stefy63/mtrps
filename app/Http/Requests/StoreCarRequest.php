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
            'car_type_id' => 'required|exists:car_types,id',
            'car_owner_id' => 'nullable|exists:car_owners,id',
            'car_brand_id' => 'nullable|exists:car_brands,id',
            'car_power_id' => 'nullable|exists:car_powers,id',
            'car_police_plate_id'  => 'nullable|exists:plates,id',
            'car_police_plate_force' => 'nullable|boolean',
            'car_civil_plate_id'  => 'nullable|exists:plates,id',
            'car_civil_plate_force' => 'nullable|boolean',
            'car_origin_plate_id'  => 'nullable|exists:plates,id',
            'car_origin_plate_force' => 'nullable|boolean',
            'car_profit_account_id' => 'nullable|exists:car_profit_accounts,id',
            'car_employment_code_id' => 'nullable|exists:car_employment_codes,id',
            'assignee_id' => 'integer|exists:offices,id',
            'equipments' => 'array|nullable',
            'model' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'cod_model' => 'nullable|string|max:255',
            'profit_account' => 'nullable|string|max:255',
            'tank' => 'nullable|integer|min:0',
            'km' => 'nullable|integer|min:0',
            'description' => 'nullable|string|max:500',
            'winter_wheels' => 'boolean',
            'wheels_type' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'tel_warranty' => 'nullable|string|max:255',
            'chassis' => 'nullable|string|max:255',
            'date_revision' => 'nullable|date',
            'date_assignee' => 'nullable|date',
            'note' => 'nullable|string'
        ];
    }
}
