<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarPlateRequest extends FormRequest
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
            'name' => [
                'required', 
                'string', 
                'max:20',
                'regex:/^[A-Z0-9\s]+$/',
                Rule::unique('car_plates', 'name')->ignore($this->car_plate?->id)
            ],
            'type' => 'required|in:POL,CIV,ALTRO',
            'date_from' => 'required|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
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
            'car_id' => 'Veicolo',
            'name' => 'Numero Targa',
            'type' => 'Tipo Targa',
            'date_from' => 'Data Inizio',
            'date_to' => 'Data Fine',
            'note' => 'Note'
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
            'name.required' => 'Il numero di targa è obbligatorio.',
            'name.unique' => 'Questa targa è già registrata nel sistema.',
            'name.regex' => 'La targa deve contenere solo lettere maiuscole, numeri e spazi.',
            'name.max' => 'La targa non può superare i 20 caratteri.',
            'car_id.required' => 'Devi selezionare un veicolo.',
            'car_id.exists' => 'Il veicolo selezionato non esiste.',
            'type.required' => 'Il tipo di targa è obbligatorio.',
            'type.in' => 'Il tipo di targa deve essere POL (Polizia), CIV (Civile) o ALTRO.',
            'date_from.required' => 'La data di inizio è obbligatoria.',
            'date_from.date' => 'La data di inizio deve essere una data valida.',
            'date_to.date' => 'La data di fine deve essere una data valida.',
            'date_to.after_or_equal' => 'La data di fine deve essere successiva o uguale alla data di inizio.'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Converti la targa in maiuscolo e rimuovi spazi extra
        if ($this->has('name')) {
            $this->merge([
                'name' => strtoupper(trim(preg_replace('/\s+/', ' ', $this->name)))
            ]);
        }
    }
}