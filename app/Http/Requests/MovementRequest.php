<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
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
        $rules = [
            'car_id' => [
                'required',
                'integer',
                'exists:cars,id'
            ],
            'office_id' => 'required|integer|exists:offices,id',
            'code' => 'required|string|max:100',
        ];
        $rules['date_from'] = 'required|date|date_format:Y-m-d H:i';
        $rules['date_to'] = 'nullable|date|date_format:Y-m-d H:i|after_or_equal:date_from';

        return $rules;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'car_id' => (int) $this->car_id,
            'date_from' => Carbon::parse($this->date_from)->format('Y-m-d H:i'),
            'date_to' => $this->date_to ? Carbon::parse($this->date_to)->format('Y-m-d H:i') : null,
        ]);
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'car_id.required' => 'Il veicolo è obbligatorio.',
            'car_id.exists' => 'Il veicolo selezionato non è valido.',
            'office_id.integer' => 'L\'ufficio deve essere un numero.',
            'office_id.required' => 'L\'ufficio è obbligatorio.',
            'office_id.exists' => 'L\'ufficio selezionato non è valido.',
            'date_from.required' => 'La data di inizio è obbligatoria.',
            'date_from.after_or_equal' => 'La data di inizio non può essere nel passato.',
            'date_to.required' => 'La data di fine è obbligatoria.',
            'date_to.after' => 'La data di fine deve essere successiva alla data di inizio.',
        ];
    }

}
