<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceGarageRequest extends FormRequest
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
            'piva' => 'nullable|numeric|digits:11',
            'cf' => 'nullable|string|size:16',
            'iban' => 'nullable|string|regex:/^IT\d{2}[A-Z]\d{22}$/i',
            'pec' => 'nullable|email|max:255',
            'acc' => 'required|in:yes,no',
            'anti_mafia' => 'required|in:yes,no',
            'durc' => 'nullable|date',
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
            'name.required' => 'Inserisci il nome dell\'officina',
            'name.max' => 'Il nome non può superare i 255 caratteri',
            'piva.numeric' => 'La P.IVA deve contenere solo numeri',
            'piva.digits' => 'La P.IVA deve essere di 11 cifre',
            'cf.size' => 'Il Codice Fiscale deve essere di 16 caratteri',
            'iban.regex' => 'L\'IBAN non è nel formato corretto (IT + 2 cifre + 1 lettera + 22 cifre)',
            'pec.email' => 'L\'indirizzo PEC non è valido',
            'pec.max' => 'L\'indirizzo PEC non può superare i 255 caratteri',
            'acc.required' => 'Specifica se l\'officina è accreditata',
            'acc.in' => 'Il valore di accreditamento non è valido',
            'anti_mafia.required' => 'Specifica se è presente la certificazione antimafia',
            'anti_mafia.in' => 'Il valore della certificazione antimafia non è valido',
            'durc.date' => 'La data DURC non è valida',
            'description.max' => 'La descrizione non può superare i 255 caratteri',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Normalizza P.IVA e CF
        if ($this->has('piva')) {
            $this->merge(['piva' => preg_replace('/\s+/', '', $this->piva)]);
        }

        if ($this->has('cf')) {
            $this->merge(['cf' => strtoupper(preg_replace('/\s+/', '', $this->cf))]);
        }

        // Normalizza IBAN
        if ($this->has('iban')) {
            $this->merge(['iban' => strtoupper(preg_replace('/\s+/', '', $this->iban))]);
        }

        // Pulizia campi vuoti
        if ($this->has('piva') && empty($this->piva)) {
            $this->merge(['piva' => null]);
        }

        if ($this->has('cf') && empty($this->cf)) {
            $this->merge(['cf' => null]);
        }

        if ($this->has('iban') && empty($this->iban)) {
            $this->merge(['iban' => null]);
        }

        if ($this->has('pec') && empty($this->pec)) {
            $this->merge(['pec' => null]);
        }

        if ($this->has('durc') && empty($this->durc)) {
            $this->merge(['durc' => null]);
        }

        if ($this->has('description') && empty($this->description)) {
            $this->merge(['description' => null]);
        }

        if ($this->has('note') && empty($this->note)) {
            $this->merge(['note' => null]);
        }
    }
}
