<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CarSetup;

class CarSetupRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $carSetupId = $this->route('car_setup') ? $this->route('car_setup')->id : null;

        return [
            'car_id' => [
                'required',
                'exists:cars,id'
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($carSetupId) {
                    // Verifica conflitti
                    $query = CarSetup::where('car_id', $this->car_id)
                        ->where('name', $value);

                    if ($carSetupId) {
                        $query->where('id', '!=', $carSetupId);
                    }

                    // Controlla sovrapposizioni di date
                    $dateFrom = $this->date_from;
                    $dateTo = $this->date_to;

                    $conflicts = $query->where(function ($q) use ($dateFrom, $dateTo) {
                        if ($dateTo) {
                            // Se ho una data fine, controllo le sovrapposizioni complete
                            $q->where(function ($q2) use ($dateFrom, $dateTo) {
                                $q2->whereBetween('date_from', [$dateFrom, $dateTo])
                                   ->orWhereBetween('date_to', [$dateFrom, $dateTo])
                                   ->orWhere(function ($q3) use ($dateFrom, $dateTo) {
                                       $q3->where('date_from', '<=', $dateFrom)
                                          ->where(function ($q4) use ($dateTo) {
                                              $q4->where('date_to', '>=', $dateTo)
                                                 ->orWhereNull('date_to');
                                          });
                                   });
                            });
                        } else {
                            // Se non ho data fine, controllo che non ci siano setup attivi
                            $q->where(function ($q2) use ($dateFrom) {
                                $q2->where('date_from', '<=', $dateFrom)
                                   ->where(function ($q3) use ($dateFrom) {
                                       $q3->whereNull('date_to')
                                          ->orWhere('date_to', '>=', $dateFrom);
                                   });
                            })->orWhere('date_from', '>=', $dateFrom);
                        }
                    })->exists();

                    if ($conflicts) {
                        $fail('Esiste già un allestimento "' . $value . '" per questo veicolo nel periodo selezionato.');
                    }
                }
            ],
            'description' => [
                'nullable',
                'string',
                'max:255'
            ],
            'date_from' => [
                'required',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) {
                    if ($this->date_to && $value > $this->date_to) {
                        $fail('La data di inizio deve essere precedente alla data di fine.');
                    }
                }
            ],
            'date_to' => [
                'nullable',
                'date',
                'after:date_from'
            ],
            'note' => [
                'nullable',
                'string',
                'max:1000'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'car_id.required' => 'Il veicolo è obbligatorio.',
            'car_id.exists' => 'Il veicolo selezionato non è valido.',
            'name.required' => 'Il nome dell\'allestimento è obbligatorio.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'description.max' => 'La descrizione non può superare i 255 caratteri.',
            'date_from.required' => 'La data di inizio è obbligatoria.',
            'date_from.date' => 'La data di inizio non è valida.',
            'date_from.before_or_equal' => 'La data di inizio non può essere futura.',
            'date_to.date' => 'La data di fine non è valida.',
            'date_to.after' => 'La data di fine deve essere successiva alla data di inizio.',
            'note.max' => 'Le note non possono superare i 1000 caratteri.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'car_id' => 'veicolo',
            'name' => 'nome allestimento',
            'description' => 'descrizione',
            'date_from' => 'data inizio',
            'date_to' => 'data fine',
            'note' => 'note'
        ];
    }
}
