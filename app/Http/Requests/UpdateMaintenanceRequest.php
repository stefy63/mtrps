<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'date_from' => 'required|date',
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
            'name.required' => 'Inserisci il tipo di manutenzione',
            'name.max' => 'Il tipo di manutenzione non può superare i 255 caratteri',
            'description.max' => 'La descrizione non può superare i 255 caratteri',
            'date_from.required' => 'Inserisci la data di inizio manutenzione',
            'date_from.date' => 'La data di inizio non è valida',
            'date_to.date' => 'La data di fine non è valida',
            'date_to.after_or_equal' => 'La data di fine deve essere successiva o uguale alla data di inizio',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Pulizia dei dati
        if ($this->has('description') && empty($this->description)) {
            $this->merge(['description' => null]);
        }

        if ($this->has('date_to') && empty($this->date_to)) {
            $this->merge(['date_to' => null]);
        }

        if ($this->has('note') && empty($this->note)) {
            $this->merge(['note' => null]);
        }
    }
}
