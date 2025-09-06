<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CarProfitAccount;

class CarProfitAccountRequest extends FormRequest
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
        $accountId = $this->route('car_profit_account')?->id;

        return [
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('car_profit_accounts')->ignore($accountId),
                'regex:/^[A-Z0-9\-\/]+$/' // Solo maiuscole, numeri e trattini
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category' => ['nullable', Rule::in(array_keys(CarProfitAccount::CATEGORIES))],
            'department' => 'nullable|string|max:100',
            'responsible' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20|regex:/^[\d\s\+\-\(\)]+$/',
            'budget_year' => 'nullable|numeric|min:0|max:9999999999.99',
            'budget_month' => 'nullable|numeric|min:0|max:99999999.99',
            'is_active' => 'boolean',
            'valid_from' => 'nullable|date',
            'valid_to' => [
                'nullable',
                'date',
                'after_or_equal:valid_from'
            ],
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Il codice è obbligatorio.',
            'code.unique' => 'Questo codice è già utilizzato.',
            'code.regex' => 'Il codice può contenere solo lettere maiuscole, numeri e trattini.',
            'name.required' => 'Il nome è obbligatorio.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'category.in' => 'La categoria selezionata non è valida.',
            'email.email' => 'L\'indirizzo email non è valido.',
            'phone.regex' => 'Il numero di telefono non è valido.',
            'budget_year.numeric' => 'Il budget annuale deve essere un numero.',
            'budget_year.min' => 'Il budget annuale non può essere negativo.',
            'budget_month.numeric' => 'Il budget mensile deve essere un numero.',
            'budget_month.min' => 'Il budget mensile non può essere negativo.',
            'valid_to.after_or_equal' => 'La data di fine validità deve essere successiva o uguale alla data di inizio.',
        ];
    }

    /**
     * Prepare data for validation
     */
    protected function prepareForValidation()
    {
        // Converte il codice in maiuscolo
        if ($this->has('code')) {
            $this->merge([
                'code' => strtoupper(trim($this->code))
            ]);
        }

        // Assicura che is_active sia booleano
        $this->merge([
            'is_active' => $this->boolean('is_active', true)
        ]);

        // Calcola budget mensile se fornito solo quello annuale
        if ($this->has('budget_year') && !$this->has('budget_month')) {
            $budgetYear = floatval($this->budget_year);
            if ($budgetYear > 0) {
                $this->merge([
                    'budget_month' => round($budgetYear / 12, 2)
                ]);
            }
        }

        // Trim dei campi stringa
        foreach (['name', 'description', 'department', 'responsible', 'email', 'phone'] as $field) {
            if ($this->has($field)) {
                $this->merge([
                    $field => trim($this->$field)
                ]);
            }
        }
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verifica che il budget mensile non superi quello annuale / 12
            if ($this->budget_year && $this->budget_month) {
                $maxMonthly = $this->budget_year / 12;
                if ($this->budget_month > $maxMonthly * 1.5) { // Tolleriamo fino al 150% per gestire stagionalità
                    $validator->errors()->add('budget_month',
                        'Il budget mensile sembra eccessivo rispetto a quello annuale.');
                }
            }

            // Verifica che se c'è un responsabile ci sia anche email o telefono
            if ($this->responsible && !$this->email && !$this->phone) {
                $validator->errors()->add('email',
                    'Inserire almeno un contatto (email o telefono) per il responsabile.');
            }

            // Avviso se il conto sta per scadere
            if ($this->valid_to) {
                $daysToExpiry = now()->diffInDays($this->valid_to, false);
                if ($daysToExpiry >= 0 && $daysToExpiry <= 30) {
                    $validator->errors()->add('valid_to',
                        'Attenzione: il conto scadrà tra ' . $daysToExpiry . ' giorni.');
                }
            }
        });
    }
}
