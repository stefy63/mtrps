<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'car_type_id' => 'Tipo Veicolo',
            'car_owner_id' => 'Proprietario',
            'car_brand_id' => 'Marca',
            'car_power_id' => 'Alimentazione',
            'car_profit_account_id' => 'Conto Economico',
            'name' => 'Nome',
            'model' => 'Modello',
            'color' => 'Colore',
            'cod_model' => 'Codice Modello',
            'profit_account' => 'Conto Profitto',
            'tank' => 'Serbatoio',
            'km' => 'Chilometraggio',
            'description' => 'Descrizione',
            'winter_wheels' => 'Pneumatici Invernali',
            'wheels_type' => 'Tipo Pneumatici',
            'warranty' => 'Garanzia',
            'tel_warranty' => 'Telefono Assistenza',
            'chassis' => 'Telaio',
            'date_revision' => 'Data Revisione',
            'doc' => 'Data Documento',
            'note' => 'Note'
        ];
    }
}