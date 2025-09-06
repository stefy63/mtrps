<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssigneeOfficeRequest extends FormRequest
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
            'car_assignee_id' => 'required|exists:car_assignees,id',
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
            'car_assignee_id.required' => 'L\'assegnatario è obbligatorio.',
            'car_assignee_id.exists' => 'L\'assegnatario selezionato non esiste.',
            'name.required' => 'Il nome dell\'ufficio è obbligatorio.',
            'name.max' => 'Il nome dell\'ufficio non può superare i 255 caratteri.',
            'description.max' => 'La descrizione non può superare i 255 caratteri.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Pulizia dei dati in input
        $this->merge([
            'name' => trim($this->name),
            'description' => $this->description ? trim($this->description) : null,
            'note' => $this->note ? trim($this->note) : null,
        ]);
    }
}
