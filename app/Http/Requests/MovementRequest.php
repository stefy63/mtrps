<?php

namespace App\Http\Requests;

use App\Models\Car;
use App\Models\Movement;
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
                'exists:cars,id'
            ],
            'office_id' => 'required|exists:offices,id',
            'code' => 'required|string|max:100',
        ];
        $rules['date_from'] = 'required|date';
        $rules['date_to'] = 'nullable|date|after:date_from';

        return $rules;
    }


    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'car_id.required' => 'Il veicolo è obbligatorio.',
            'car_id.exists' => 'Il veicolo selezionato non è valido.',
            'driver_id.required' => 'Il conducente è obbligatorio.',
            'driver_id.exists' => 'Il conducente selezionato non è valido.',
            'departure_datetime.required' => 'La data/ora di partenza è obbligatoria.',
            'departure_datetime.after_or_equal' => 'La partenza non può essere nel passato.',
            'arrival_datetime.required' => 'La data/ora di arrivo è obbligatoria.',
            'arrival_datetime.after' => 'L\'arrivo deve essere successivo alla partenza.',
            'departure_location.required' => 'Il luogo di partenza è obbligatorio.',
            'arrival_location.required' => 'Il luogo di arrivo è obbligatorio.',
            'purpose.required' => 'Lo scopo del movimento è obbligatorio.',
            'km_end.gt' => 'I km finali devono essere maggiori di quelli iniziali.',
            'overnight_location.required_if' => 'Il luogo di pernottamento è obbligatorio se previsto.',
            'passengers.*.exists' => 'Uno o più passeggeri selezionati non sono validi.',
        ];
    }

}
