<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Movement;
use App\Models\Car;
use Carbon\Carbon;

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
        $movementId = $this->route('movement')?->id;

        $rules = [
            'car_id' => [
                'required',
                'exists:cars,id',
                function ($attribute, $value, $fail) use ($movementId) {
                    $this->validateCarAvailability($value, $fail, $movementId);
                }
            ],
            'driver_id' => 'required|exists:users,id',
            'requested_by' => 'nullable|exists:users,id',
            'authorized_by' => 'nullable|exists:users,id',
            'status' => ['required', Rule::in(array_keys(Movement::getStatuses()))],
            'type' => ['required', Rule::in(array_keys(Movement::getTypes()))],
            'purpose' => 'required|string|max:255',
            'purpose_details' => 'nullable|string|max:1000',

            // Date e orari
            'departure_datetime' => 'required|date|after_or_equal:today',
            'arrival_datetime' => [
                'required',
                'date',
                'after:departure_datetime',
                function ($attribute, $value, $fail) {
                    $this->validateReasonableDuration($value, $fail);
                }
            ],
            'actual_departure' => 'nullable|date|after_or_equal:departure_datetime',
            'actual_arrival' => 'nullable|date|after:actual_departure',

            // Località
            'departure_location' => 'required|string|max:255',
            'departure_address' => 'nullable|string|max:500',
            'departure_lat' => 'nullable|numeric|between:-90,90',
            'departure_lng' => 'nullable|numeric|between:-180,180',
            'arrival_location' => 'required|string|max:255',
            'arrival_address' => 'nullable|string|max:500',
            'arrival_lat' => 'nullable|numeric|between:-90,90',
            'arrival_lng' => 'nullable|numeric|between:-180,180',

            // Chilometraggio
            'km_start' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $this->validateKmStart($value, $fail);
                }
            ],
            'km_end' => [
                'nullable',
                'integer',
                'min:0',
                'gt:km_start',
                function ($attribute, $value, $fail) {
                    $this->validateReasonableKm($value, $fail);
                }
            ],
            'estimated_km' => 'nullable|integer|min:1|max:5000',
            'estimated_duration' => 'nullable|integer|min:1|max:2880', // max 48 ore
            'route_type' => 'nullable|string|in:autostrada,urbano,misto,extraurbano',

            // Passeggeri
            'passengers_count' => 'required|integer|min:0|max:50',
            'passengers' => 'nullable|array',
            'passengers.*' => 'exists:users,id',
            'external_passengers' => 'nullable|string|max:500',

            // Costi
            'fuel_liters' => 'nullable|numeric|min:0|max:999',
            'fuel_cost' => 'nullable|numeric|min:0|max:9999',
            'toll_cost' => 'nullable|numeric|min:0|max:999',
            'parking_cost' => 'nullable|numeric|min:0|max:999',
            'other_costs' => 'nullable|numeric|min:0|max:9999',
            'cost_notes' => 'nullable|string|max:255',

            // Altri campi
            'mission_order' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
            'incidents' => 'nullable|string|max:1000',
            'requires_overnight' => 'boolean',
            'overnight_location' => 'required_if:requires_overnight,true|nullable|string|max:255',
            'vehicle_check_before' => 'boolean',
            'vehicle_check_after' => 'boolean',
            'vehicle_damages' => 'nullable|string|max:1000',
        ];

        // Se stiamo modificando un movimento completato, allentiamo alcune regole
        if ($movementId && $this->status === Movement::STATUS_COMPLETED) {
            $rules['departure_datetime'] = 'required|date';
            $rules['arrival_datetime'] = 'required|date|after:departure_datetime';
        }

        return $rules;
    }

    /**
     * Validate car availability for the period
     */
    protected function validateCarAvailability($carId, $fail, $excludeId = null)
    {
        if (!$this->departure_datetime || !$this->arrival_datetime) {
            return;
        }

        $car = Car::find($carId);
        if (!$car) {
            return;
        }

        // Controlla sovrapposizioni con altri movimenti
        $overlappingMovements = Movement::where('car_id', $carId)
            ->where('status', '!=', Movement::STATUS_CANCELLED)
            ->where(function ($query) {
                $query->whereBetween('departure_datetime', [$this->departure_datetime, $this->arrival_datetime])
                    ->orWhereBetween('arrival_datetime', [$this->departure_datetime, $this->arrival_datetime])
                    ->orWhere(function ($q) {
                        $q->where('departure_datetime', '<=', $this->departure_datetime)
                            ->where('arrival_datetime', '>=', $this->arrival_datetime);
                    });
            });

        if ($excludeId) {
            $overlappingMovements->where('id', '!=', $excludeId);
        }

        if ($overlappingMovements->exists()) {
            $fail('Il veicolo non è disponibile nel periodo selezionato.');
        }
    }

    /**
     * Validate km start is greater than last movement km end
     */
    protected function validateKmStart($value, $fail)
    {
        if (!$value || !$this->car_id) {
            return;
        }

        $lastMovement = Movement::where('car_id', $this->car_id)
            ->where('status', Movement::STATUS_COMPLETED)
            ->whereNotNull('km_end')
            ->orderBy('actual_arrival', 'desc')
            ->orderBy('arrival_datetime', 'desc')
            ->first();

        if ($lastMovement && $lastMovement->km_end > $value) {
            $fail("I km iniziali devono essere almeno {$lastMovement->km_end} (ultimo movimento).");
        }
    }

    /**
     * Validate reasonable km
     */
    protected function validateReasonableKm($value, $fail)
    {
        if (!$value || !$this->km_start) {
            return;
        }

        $kmDiff = $value - $this->km_start;

        // Calcola durata in ore
        $duration = Carbon::parse($this->arrival_datetime)->diffInHours(Carbon::parse($this->departure_datetime));

        // Velocità media massima ragionevole (150 km/h)
        $maxReasonableKm = $duration * 150;

        if ($kmDiff > $maxReasonableKm) {
            $fail('La percorrenza chilometrica sembra eccessiva per la durata del viaggio.');
        }
    }

    /**
     * Validate reasonable duration
     */
    protected function validateReasonableDuration($value, $fail)
    {
        if (!$this->departure_datetime) {
            return;
        }

        $duration = Carbon::parse($value)->diffInHours(Carbon::parse($this->departure_datetime));

        // Max 72 ore per un singolo movimento
        if ($duration > 72) {
            $fail('La durata del movimento non può superare le 72 ore.');
        }
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

    /**
     * Prepare data for validation
     */
    protected function prepareForValidation()
    {
        // Converti passengers in array se è una stringa
        if ($this->has('passengers') && is_string($this->passengers)) {
            $this->merge([
                'passengers' => json_decode($this->passengers, true) ?: []
            ]);
        }

        // Assicura che i booleani siano corretti
        $this->merge([
            'requires_overnight' => $this->boolean('requires_overnight'),
            'vehicle_check_before' => $this->boolean('vehicle_check_before'),
            'vehicle_check_after' => $this->boolean('vehicle_check_after'),
        ]);

        // Conta automaticamente i passeggeri se forniti
        if ($this->has('passengers') && is_array($this->passengers)) {
            $internalCount = count($this->passengers);
            $externalCount = 0;

            if ($this->external_passengers) {
                // Conta i passeggeri esterni (assumendo formato "Nome1, Nome2, Nome3")
                $externalCount = count(array_filter(array_map('trim', explode(',', $this->external_passengers))));
            }

            $this->merge([
                'passengers_count' => $internalCount + $externalCount
            ]);
        }
    }
}
