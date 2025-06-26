<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateCarEquipmentRequest extends FormRequest
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
            'description' => 'nullable|string|max:255',
            'date_from' => 'required|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
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
            'car_id.required' => 'Il veicolo è obbligatorio.',
            'car_id.exists' => 'Il veicolo selezionato non esiste.',
            'name.required' => 'Il nome dell\'equipaggiamento è obbligatorio.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'description.max' => 'La descrizione non può superare i 255 caratteri.',
            'date_from.required' => 'La data di installazione è obbligatoria.',
            'date_from.date' => 'La data di installazione non è valida.',
            'date_to.date' => 'La data di rimozione non è valida.',
            'date_to.after_or_equal' => 'La data di rimozione deve essere successiva o uguale alla data di installazione.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $data = [
            'name' => trim($this->name),
            'description' => $this->description ? trim($this->description) : null,
            'note' => $this->note ? trim($this->note) : null,
        ];

        // Gestione date
        if ($this->date_from) {
            try {
                $data['date_from'] = Carbon::parse($this->date_from)->format('Y-m-d');
            } catch (\Exception $e) {
                $data['date_from'] = $this->date_from;
            }
        }

        if ($this->date_to) {
            try {
                $data['date_to'] = Carbon::parse($this->date_to)->format('Y-m-d');
            } catch (\Exception $e) {
                $data['date_to'] = $this->date_to;
            }
        }

        $this->merge($data);
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->car_id) {
                // Verifica sovrapposizioni con altri equipaggiamenti dello stesso tipo (escludendo se stesso)
                $query = \App\Models\CarEquipment::where('car_id', $this->car_id)
                    ->where('name', $this->name)
                    ->where('id', '!=', $this->route('car_equipment')->id);

                if ($query->exists()) {
                    // Controlla sovrapposizioni di date
                    $overlapping = $query->where(function ($q) {
                        $q->where(function ($subQuery) {
                            $subQuery->whereNull('date_to')
                                     ->where('date_from', '<=', $this->date_to ?? '9999-12-31');
                        })->orWhere(function ($subQuery) {
                            $subQuery->whereNotNull('date_to')
                                     ->where('date_from', '<=', $this->date_to ?? '9999-12-31')
                                     ->where('date_to', '>=', $this->date_from);
                        });
                    });

                    if ($overlapping->exists()) {
                        $validator->errors()->add('date_from',
                            'Esiste già un equipaggiamento "' . $this->name . '" per questo veicolo nel periodo specificato.');
                    }
                }
            }
        });
    }
}
