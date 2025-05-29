<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarPowerRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:car_powers,name,' . ($this->car_power ? $this->car_power->id : 'NULL'),
            'description' => 'nullable|string|max:500'
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
            'name' => 'Nome Alimentazione',
            'description' => 'Descrizione'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Il nome dell\'alimentazione è obbligatorio.',
            'name.unique' => 'Questa alimentazione è già presente nel sistema.',
            'name.max' => 'Il nome dell\'alimentazione non può superare i 255 caratteri.',
            'description.max' => 'La descrizione non può superare i 500 caratteri.'
        ];
    }
}