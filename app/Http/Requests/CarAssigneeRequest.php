<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarAssigneeRequest extends FormRequest
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
            'description' => 'nullable|string|max:500',
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
            'name' => 'Nome Assegnatario',
            'description' => 'Descrizione',
            'date_from' => 'Data Inizio Assegnazione',
            'date_to' => 'Data Fine Assegnazione',
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
            'name.required' => 'Il nome dell\'assegnatario è obbligatorio.',
            'name.max' => 'Il nome dell\'assegnatario non può superare i 255 caratteri.',
            'car_id.required' => 'Devi selezionare un veicolo.',
            'car_id.exists' => 'Il veicolo selezionato non esiste.',
            'date_from.required' => 'La data di inizio assegnazione è obbligatoria.',
            'date_from.date' => 'La data di inizio deve essere una data valida.',
            'date_to.date' => 'La data di fine deve essere una data valida.',
            'date_to.after_or_equal' => 'La data di fine deve essere successiva o uguale alla data di inizio.',
            'description.max' => 'La descrizione non può superare i 500 caratteri.'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Pulisce il nome rimuovendo spazi extra
        if ($this->has('name')) {
            $this->merge([
                'name' => trim(preg_replace('/\s+/', ' ', $this->name))
            ]);
        }
    }

    /**
     * Custom validation rules
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Controlla sovrapposizioni di assegnazioni per lo stesso veicolo
            if ($this->car_id && $this->date_from) {
                $query = \App\Models\CarAssignee::where('car_id', $this->car_id)
                    ->where('date_from', '<=', $this->date_to ?? '9999-12-31')
                    ->where(function($q) {
                        $q->whereNull('date_to')
                          ->orWhere('date_to', '>=', $this->date_from);
                    });

                // Escludi l'assegnazione corrente se stiamo aggiornando
                if ($this->car_assignee) {
                    $query->where('id', '!=', $this->car_assignee->id);
                }

                if ($query->exists()) {
                    $validator->errors()->add('date_from', 'Il veicolo è già assegnato in questo periodo.');
                }
            }
        });
    }
}