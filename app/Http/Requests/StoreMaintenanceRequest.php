<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest
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
            'car_id' => 'required|exists:cars,id',
            'garage_id' => 'required|exists:maintenance_garages,id',
            'type_id' => 'nullable|exists:maintenance_types,id',
            'description' => 'nullable|string|max:255',
            'date_from' => 'required|date|after:2000-01-01',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'note' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'car_id.required' => 'Seleziona un veicolo',
            'car_id.exists' => 'Il veicolo selezionato non è valido',
            'garage_id.required' => 'Seleziona una Officina',
            'garage_id.exists' => 'l\'officina selezionato non è valida',
            'type_id.exists' => 'Il tipo intervento selezionato non è valido',
            'description.max' => 'La descrizione non può superare i 255 caratteri',
            'date_from.required' => 'Inserisci la data di inizio manutenzione',
            'date_from.date' => 'La data di inizio non è valida',
            'date_from.after' => 'Inserire una data valida maggiore del 2000',
            'date_to.date' => 'La data di fine non è valida',
            'date_to.after_or_equal' => 'La data di fine deve essere successiva o uguale alla data di inizio',
        ];
    }

}
