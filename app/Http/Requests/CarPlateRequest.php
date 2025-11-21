<?php

namespace App\Http\Requests;

use App\Enum\PlateTypeEnum;
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
            'name' => [
                'required', 
                'string', 
                'max:20',
                'regex:/^[A-Z0-9\s]+$/',
                Rule::unique('plates', 'name')->ignore($this->car_plate?->id)
            ],
            'type' => [
                'required',
                Rule::enum(PlateTypeEnum::class)
            ],
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
            'name' => 'Numero Targa',
            'type' => 'Tipo Targa',
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
            'type.required' => 'Il tipo di targa è obbligatorio.',
            'type.in' => 'Il tipo di targa deve essere POLIZIA, CIVILE o ALTRO.',
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