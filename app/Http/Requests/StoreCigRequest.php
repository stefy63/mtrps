<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCigRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::user()->id;
        // dd($this->all());
        return [
            'car_id' => 'required|exists:cars,id',
            'maintenance_garage_id' => 'required|exists:maintenance_garages,id',
            'user_rup_id' => [
                'nullable',
                'numeric',
                'exists:users,id',  
                // Rule::in([$userId])
            ],
            'user_support_id' => [
                'nullable',
                'numeric',
                'exists:users,id',
                // Rule::in([$userId])
            ],
            'user_tender_notice_id' => [
                'nullable',
                'numeric',
                'exists:users,id',
                // Rule::in([$userId])
            ],
            'user_tester_id' => [
                'nullable',
                'numeric',
                'exists:users,id',
                // Rule::in([$userId])
            ],
            'date' => 'nullable|date',
            'ce' => 'nullable|string|max:255',  
            'description' => 'nullable|string|max:255',
            'preventive' => 'nullable|string|max:255',
            'final_report' => 'nullable|string|max:255',
            'taxable' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'cig' => 'required|string|max:255|unique:cigs,cig',
            'note' => 'nullable|string|max:255',
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
            'maintenance_garage_id.required' => 'Seleziona un\'officina',
            'maintenance_garage_id.exists' => 'L\'officina selezionata non è valida',
            'user_rup_id.exists' => 'Il RUP selezionato non è valido',
            'user_support_id.exists' => 'Il supporto RUP selezionato non è valido',
            'user_tender_notice_id.exists' => 'Il responsabile bando selezionato non è valido',
            'user_tester_id.exists' => 'Il collaudatore selezionato non è valido',
            'date.date' => 'La data non è valida',
            'ce.max' => 'Il codice CE non può superare i 255 caratteri',
            'description.max' => 'La descrizione non può superare i 255 caratteri',
            'preventive.max' => 'Il preventivo non può superare i 255 caratteri',
            'final_report.max' => 'La relazione finale non può superare i 255 caratteri',
            'taxable.numeric' => 'L\'imponibile deve essere un numero',
            'taxable.min' => 'L\'imponibile non può essere negativo',
            'vat.numeric' => 'L\'IVA deve essere un numero',
            'vat.min' => 'L\'IVA non può essere negativa',
            'cig.required' => 'Inserisci il codice CIG',
            'cig.max' => 'Il CIG non può superare i 255 caratteri',
            'cig.unique' => 'Questo CIG è già stato registrato',
            'note.max' => 'Le note non possono superare i 255 caratteri',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Pulizia dei dati
        $fieldsToClean = [
            'user_rup_id', 'user_support_id', 'user_tender_notice_id', 'user_tester_id',
            'ce', 'description', 'preventive', 'final_report', 'note'
        ];

        foreach ($fieldsToClean as $field) {
            if ($this->has($field) && empty($this->$field)) {
                $this->merge([$field => null]);
            }
        }

        // Converti importi in numeri
        if ($this->has('taxable')) {
            $this->merge(['taxable' => str_replace(',', '.', $this->taxable)]);
        }

        if ($this->has('vat')) {
            $this->merge(['vat' => str_replace(',', '.', $this->vat)]);
        }

        // Uppercase per CIG
        if ($this->has('cig')) {
            $this->merge(['cig' => strtoupper(trim($this->cig))]);
        }

        // Converti i campi utente in ID
        // $userFields = ['user_rup_id', 'user_support_id', 'user_tender_notice_id', 'user_tester_id'];
        // foreach ($userFields as $field) {
        //     if ($this->has($field) && !empty($this[$field])) {
        //         $this->merge([$field => intval($this[$field])]);
        //     }
        // }
    }
}
