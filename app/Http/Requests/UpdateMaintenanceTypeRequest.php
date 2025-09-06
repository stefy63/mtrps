<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceTypeRequest extends FormRequest
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
            'maintenance_id' => 'required|exists:maintenances,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
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
            'maintenance_id.required' => 'Seleziona una manutenzione',
            'maintenance_id.exists' => 'La manutenzione selezionata non è valida',
            'name.required' => 'Inserisci il tipo di intervento',
            'name.max' => 'Il tipo di intervento non può superare i 255 caratteri',
            'description.max' => 'La descrizione non può superare i 255 caratteri',
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

        if ($this->has('note') && empty($this->note)) {
            $this->merge(['note' => null]);
        }
    }
}
