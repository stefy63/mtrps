<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- Informazioni Base --}}
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-info-circle"></i> Informazioni Movimento
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Codice --}}
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="code"
                                   class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $movement?->code) }}"
                                   id="code"
                                   placeholder="Codice"
                                   readonly>
                            <label for="code">{{ __('Codice Movimento') }}</label>
                            {!! $errors->first('code', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Stato --}}
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="status"--}}
{{--                                    class="form-select @error('status') is-invalid @enderror"--}}
{{--                                    id="status">--}}
{{--                                @foreach($statuses as $key => $label)--}}
{{--                                    <option value="{{ $key }}" {{ old('status', $movement?->status ?? 'pending') == $key ? 'selected' : '' }}>--}}
{{--                                        {{ $label }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="status">{{ __('Stato') }}</label>--}}
{{--                            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Tipo --}}
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="type"--}}
{{--                                    class="form-select @error('type') is-invalid @enderror"--}}
{{--                                    id="type"--}}
{{--                                    required>--}}
{{--                                <option value="">Seleziona tipo...</option>--}}
{{--                                @foreach($types as $key => $label)--}}
{{--                                    <option value="{{ $key }}" {{ old('type', $movement?->type) == $key ? 'selected' : '' }}>--}}
{{--                                        {{ $label }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="type">{{ __('Tipo Movimento') }} *</label>--}}
{{--                            {!! $errors->first('type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Scopo --}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="purpose"--}}
{{--                                   class="form-control @error('purpose') is-invalid @enderror"--}}
{{--                                   value="{{ old('purpose', $movement?->purpose) }}"--}}
{{--                                   id="purpose"--}}
{{--                                   placeholder="Scopo"--}}
{{--                                   required>--}}
{{--                            <label for="purpose">{{ __('Scopo/Motivo') }} *</label>--}}
{{--                            {!! $errors->first('purpose', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <small class="text-muted">Es: Riunione presso Ministero, Trasporto delegazione, Sopralluogo cantiere</small>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Dettagli Scopo --}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <textarea name="purpose_details"--}}
{{--                                      class="form-control @error('purpose_details') is-invalid @enderror"--}}
{{--                                      id="purpose_details"--}}
{{--                                      placeholder="Dettagli"--}}
{{--                                      style="height: 80px">{{ old('purpose_details', $movement?->purpose_details) }}</textarea>--}}
{{--                            <label for="purpose_details">{{ __('Dettagli aggiuntivi') }}</label>--}}
{{--                            {!! $errors->first('purpose_details', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

        {{-- Veicolo e Personale --}}
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <i class="bi bi-truck"></i> Veicolo e Personale
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Veicolo --}}
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <select name="car_id"
                                    class="form-select @error('car_id') is-invalid @enderror"
                                    id="car_id"
                                    required>
                                <option value="">Seleziona veicolo...</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}"
                                            {{ old('car_id', $movement?->car_id) == $car->id ? 'selected' : '' }}
                                            data-brand="{{ $car->carBrand?->name }}"
                                            data-type="{{ $car->carType?->name }}"
                                            data-power="{{ $car->carPower?->name }}">
                                        {{ $car->name }}
                                        @if($car->carPlates->first())
                                            - {{ $car->carPlates->first()->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <label for="car_id">{{ __('Veicolo') }} *</label>
                            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <div id="car-info" class="mt-2 text-muted small"></div>
                        </div>
                    </div>

                    {{-- Conducente --}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="driver_id"--}}
{{--                                    class="form-select @error('driver_id') is-invalid @enderror"--}}
{{--                                    id="driver_id"--}}
{{--                                    required>--}}
{{--                                <option value="">Seleziona conducente...</option>--}}
{{--                                @foreach($drivers as $driver)--}}
{{--                                    <option value="{{ $driver->id }}" {{ old('driver_id', $movement?->driver_id ?? Auth::id()) == $driver->id ? 'selected' : '' }}>--}}
{{--                                        {{ $driver->name }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="driver_id">{{ __('Conducente') }} *</label>--}}
{{--                            {!! $errors->first('driver_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Richiedente --}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="requested_by"--}}
{{--                                    class="form-select @error('requested_by') is-invalid @enderror"--}}
{{--                                    id="requested_by">--}}
{{--                                <option value="">Seleziona richiedente...</option>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    <option value="{{ $user->id }}" {{ old('requested_by', $movement?->requested_by ?? Auth::id()) == $user->id ? 'selected' : '' }}>--}}
{{--                                        {{ $user->name }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="requested_by">{{ __('Richiesto da') }}</label>--}}
{{--                            {!! $errors->first('requested_by', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

        {{-- Date e Orari --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <i class="bi bi-calendar-event"></i> Date e Orari
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Partenza Prevista --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
{{--                            <input type="datetime-local"--}}
{{--                                   name="departure_datetime"--}}
{{--                                   class="form-control @error('departure_datetime') is-invalid @enderror"--}}
{{--                                   value="{{ old('departure_datetime', $movement?->departure_datetime?->format('Y-m-d\TH:i')) }}"--}}
{{--                                   id="departure_datetime"--}}
{{--                                   required>--}}
                            <label for="departure_datetime">{{ __('Partenza Prevista') }} *</label>
                            {!! $errors->first('departure_datetime', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Arrivo Previsto --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
{{--                            <input type="datetime-local"--}}
{{--                                   name="arrival_datetime"--}}
{{--                                   class="form-control @error('arrival_datetime') is-invalid @enderror"--}}
{{--                                   value="{{ old('arrival_datetime', $movement?->arrival_datetime?->format('Y-m-d\TH:i')) }}"--}}
{{--                                   id="arrival_datetime"--}}
{{--                                   required>--}}
                            <label for="arrival_datetime">{{ __('Arrivo Previsto') }} *</label>
                            {!! $errors->first('arrival_datetime', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Partenza Effettiva --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="datetime-local"--}}
{{--                                   name="actual_departure"--}}
{{--                                   class="form-control @error('actual_departure') is-invalid @enderror"--}}
{{--                                   value="{{ old('actual_departure', $movement?->actual_departure?->format('Y-m-d\TH:i')) }}"--}}
{{--                                   id="actual_departure">--}}
{{--                            <label for="actual_departure">{{ __('Partenza Effettiva') }}</label>--}}
{{--                            {!! $errors->first('actual_departure', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Arrivo Effettivo --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="datetime-local"--}}
{{--                                   name="actual_arrival"--}}
{{--                                   class="form-control @error('actual_arrival') is-invalid @enderror"--}}
{{--                                   value="{{ old('actual_arrival', $movement?->actual_arrival?->format('Y-m-d\TH:i')) }}"--}}
{{--                                   id="actual_arrival">--}}
{{--                            <label for="actual_arrival">{{ __('Arrivo Effettivo') }}</label>--}}
{{--                            {!! $errors->first('actual_arrival', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Alert disponibilità --}}
                    <div class="col-md-12">
                        <div id="availability-alert" class="alert d-none" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span id="availability-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Località --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header bg-warning">--}}
{{--                <i class="bi bi-geo-alt"></i> Località--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- Partenza --}}
{{--                    <div class="col-md-6">--}}
{{--                        <h6 class="text-muted mb-3"><i class="bi bi-geo"></i> Partenza</h6>--}}

{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="departure_location"--}}
{{--                                   class="form-control @error('departure_location') is-invalid @enderror"--}}
{{--                                   value="{{ old('departure_location', $movement?->departure_location) }}"--}}
{{--                                   id="departure_location"--}}
{{--                                   list="departure-suggestions"--}}
{{--                                   required>--}}
{{--                            <label for="departure_location">{{ __('Luogo di Partenza') }} *</label>--}}
{{--                            {!! $errors->first('departure_location', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <datalist id="departure-suggestions">--}}
{{--                                <option value="Sede Centrale">--}}
{{--                                <option value="Garage Comunale">--}}
{{--                                <option value="Ufficio">--}}
{{--                                @foreach($frequentDestinations as $destination)--}}
{{--                                    <option value="{{ $destination }}">--}}
{{--                                @endforeach--}}
{{--                            </datalist>--}}
{{--                        </div>--}}

{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="departure_address"--}}
{{--                                   class="form-control @error('departure_address') is-invalid @enderror"--}}
{{--                                   value="{{ old('departure_address', $movement?->departure_address) }}"--}}
{{--                                   id="departure_address"--}}
{{--                                   placeholder="Indirizzo">--}}
{{--                            <label for="departure_address">{{ __('Indirizzo Completo') }}</label>--}}
{{--                            {!! $errors->first('departure_address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-floating mb-3">--}}
{{--                                    <input type="number"--}}
{{--                                           name="departure_lat"--}}
{{--                                           class="form-control @error('departure_lat') is-invalid @enderror"--}}
{{--                                           value="{{ old('departure_lat', $movement?->departure_lat) }}"--}}
{{--                                           id="departure_lat"--}}
{{--                                           step="0.0000001"--}}
{{--                                           placeholder="Latitudine">--}}
{{--                                    <label for="departure_lat">{{ __('Latitudine') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-floating mb-3">--}}
{{--                                    <input type="number"--}}
{{--                                           name="departure_lng"--}}
{{--                                           class="form-control @error('departure_lng') is-invalid @enderror"--}}
{{--                                           value="{{ old('departure_lng', $movement?->departure_lng) }}"--}}
{{--                                           id="departure_lng"--}}
{{--                                           step="0.0000001"--}}
{{--                                           placeholder="Longitudine">--}}
{{--                                    <label for="departure_lng">{{ __('Longitudine') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Arrivo --}}
{{--                    <div class="col-md-6">--}}
{{--                        <h6 class="text-muted mb-3"><i class="bi bi-geo-alt-fill text-danger"></i> Arrivo</h6>--}}

{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="arrival_location"--}}
{{--                                   class="form-control @error('arrival_location') is-invalid @enderror"--}}
{{--                                   value="{{ old('arrival_location', $movement?->arrival_location) }}"--}}
{{--                                   id="arrival_location"--}}
{{--                                   list="arrival-suggestions"--}}
{{--                                   required>--}}
{{--                            <label for="arrival_location">{{ __('Luogo di Arrivo') }} *</label>--}}
{{--                            {!! $errors->first('arrival_location', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <datalist id="arrival-suggestions">--}}
{{--                                @foreach($frequentDestinations as $destination)--}}
{{--                                    <option value="{{ $destination }}">--}}
{{--                                @endforeach--}}
{{--                            </datalist>--}}
{{--                        </div>--}}

{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="arrival_address"--}}
{{--                                   class="form-control @error('arrival_address') is-invalid @enderror"--}}
{{--                                   value="{{ old('arrival_address', $movement?->arrival_address) }}"--}}
{{--                                   id="arrival_address"--}}
{{--                                   placeholder="Indirizzo">--}}
{{--                            <label for="arrival_address">{{ __('Indirizzo Completo') }}</label>--}}
{{--                            {!! $errors->first('arrival_address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-floating mb-3">--}}
{{--                                    <input type="number"--}}
{{--                                           name="arrival_lat"--}}
{{--                                           class="form-control @error('arrival_lat') is-invalid @enderror"--}}
{{--                                           value="{{ old('arrival_lat', $movement?->arrival_lat) }}"--}}
{{--                                           id="arrival_lat"--}}
{{--                                           step="0.0000001"--}}
{{--                                           placeholder="Latitudine">--}}
{{--                                    <label for="arrival_lat">{{ __('Latitudine') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-floating mb-3">--}}
{{--                                    <input type="number"--}}
{{--                                           name="arrival_lng"--}}
{{--                                           class="form-control @error('arrival_lng') is-invalid @enderror"--}}
{{--                                           value="{{ old('arrival_lng', $movement?->arrival_lng) }}"--}}
{{--                                           id="arrival_lng"--}}
{{--                                           step="0.0000001"--}}
{{--                                           placeholder="Longitudine">--}}
{{--                                    <label for="arrival_lng">{{ __('Longitudine') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{-- Percorso e Chilometraggio --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header bg-dark text-white">--}}
{{--                <i class="bi bi-speedometer2"></i> Percorso e Chilometraggio--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- KM Iniziali --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="number"--}}
{{--                                   name="km_start"--}}
{{--                                   class="form-control @error('km_start') is-invalid @enderror"--}}
{{--                                   value="{{ old('km_start', $movement?->km_start) }}"--}}
{{--                                   id="km_start"--}}
{{--                                   min="0">--}}
{{--                            <label for="km_start">{{ __('KM Iniziali') }}</label>--}}
{{--                            {!! $errors->first('km_start', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            @if(isset($lastKm) && $lastKm)--}}
{{--                                <small class="text-muted">Ultimo km registrato: {{ number_format($lastKm) }}</small>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- KM Finali --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="number"--}}
{{--                                   name="km_end"--}}
{{--                                   class="form-control @error('km_end') is-invalid @enderror"--}}
{{--                                   value="{{ old('km_end', $movement?->km_end) }}"--}}
{{--                                   id="km_end"--}}
{{--                                   min="0">--}}
{{--                            <label for="km_end">{{ __('KM Finali') }}</label>--}}
{{--                            {!! $errors->first('km_end', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- KM Totali (calcolato) --}}
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="number"--}}
{{--                                   class="form-control"--}}
{{--                                   id="km_total_display"--}}
{{--                                   readonly--}}
{{--                                   value="{{ old('km_total', $movement?->km_total) }}">--}}
{{--                            <label for="km_total_display">{{ __('KM Percorsi') }}</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- KM Stimati --}}
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="number"--}}
{{--                                   name="estimated_km"--}}
{{--                                   class="form-control @error('estimated_km') is-invalid @enderror"--}}
{{--                                   value="{{ old('estimated_km', $movement?->estimated_km) }}"--}}
{{--                                   id="estimated_km"--}}
{{--                                   min="1"--}}
{{--                                   max="5000">--}}
{{--                            <label for="estimated_km">{{ __('KM Stimati') }}</label>--}}
{{--                            {!! $errors->first('estimated_km', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Tipo Percorso --}}
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="route_type"--}}
{{--                                    class="form-select @error('route_type') is-invalid @enderror"--}}
{{--                                    id="route_type">--}}
{{--                                <option value="">Seleziona...</option>--}}
{{--                                <option value="urbano" {{ old('route_type', $movement?->route_type) == 'urbano' ? 'selected' : '' }}>Urbano</option>--}}
{{--                                <option value="extraurbano" {{ old('route_type', $movement?->route_type) == 'extraurbano' ? 'selected' : '' }}>Extraurbano</option>--}}
{{--                                <option value="autostrada" {{ old('route_type', $movement?->route_type) == 'autostrada' ? 'selected' : '' }}>Autostrada</option>--}}
{{--                                <option value="misto" {{ old('route_type', $movement?->route_type) == 'misto' ? 'selected' : '' }}>Misto</option>--}}
{{--                            </select>--}}
{{--                            <label for="route_type">{{ __('Tipo Percorso') }}</label>--}}
{{--                            {!! $errors->first('route_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{-- Passeggeri --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header bg-secondary text-white">--}}
{{--                <i class="bi bi-people"></i> Passeggeri--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- Passeggeri Interni --}}
{{--                    <div class="col-md-6">--}}
{{--                        <label class="form-label">{{ __('Passeggeri Interni (Utenti Sistema)') }}</label>--}}
{{--                        <select name="passengers[]"--}}
{{--                                class="form-select @error('passengers') is-invalid @enderror"--}}
{{--                                id="passengers"--}}
{{--                                multiple--}}
{{--                                size="5">--}}
{{--                            @foreach($users as $user)--}}
{{--                                <option value="{{ $user->id }}"--}}
{{--                                    {{ (collect(old('passengers', $movement?->passengers ?? []))->contains($user->id)) ? 'selected' : '' }}>--}}
{{--                                    {{ $user->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        {!! $errors->first('passengers', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        <small class="text-muted">Tieni premuto Ctrl per selezionare più passeggeri</small>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Passeggeri Esterni --}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <textarea name="external_passengers"--}}
{{--                                      class="form-control @error('external_passengers') is-invalid @enderror"--}}
{{--                                      id="external_passengers"--}}
{{--                                      style="height: 115px"--}}
{{--                                      placeholder="Passeggeri esterni">{{ old('external_passengers', $movement?->external_passengers) }}</textarea>--}}
{{--                            <label for="external_passengers">{{ __('Passeggeri Esterni') }}</label>--}}
{{--                            {!! $errors->first('external_passengers', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <small class="text-muted">Separa i nomi con virgola. Es: Mario Rossi, Anna Verdi</small>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Conteggio Totale --}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="alert alert-info mt-2">--}}
{{--                            <i class="bi bi-info-circle"></i>--}}
{{--                            Totale passeggeri: <strong id="total-passengers">0</strong>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Costi --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header">--}}
{{--                <i class="bi bi-currency-euro"></i> Costi--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- Carburante --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <span class="input-group-text"><i class="bi bi-fuel-pump"></i></span>--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="number"--}}
{{--                                       name="fuel_liters"--}}
{{--                                       class="form-control @error('fuel_liters') is-invalid @enderror"--}}
{{--                                       value="{{ old('fuel_liters', $movement?->fuel_liters) }}"--}}
{{--                                       id="fuel_liters"--}}
{{--                                       step="0.01"--}}
{{--                                       min="0"--}}
{{--                                       max="999">--}}
{{--                                <label for="fuel_liters">{{ __('Litri Carburante') }}</label>--}}
{{--                            </div>--}}
{{--                            {!! $errors->first('fuel_liters', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Costo Carburante --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <span class="input-group-text">€</span>--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="number"--}}
{{--                                       name="fuel_cost"--}}
{{--                                       class="form-control cost-input @error('fuel_cost') is-invalid @enderror"--}}
{{--                                       value="{{ old('fuel_cost', $movement?->fuel_cost) }}"--}}
{{--                                       id="fuel_cost"--}}
{{--                                       step="0.01"--}}
{{--                                       min="0"--}}
{{--                                       max="9999">--}}
{{--                                <label for="fuel_cost">{{ __('Costo Carburante') }}</label>--}}
{{--                            </div>--}}
{{--                            {!! $errors->first('fuel_cost', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Pedaggi --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <span class="input-group-text">€</span>--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="number"--}}
{{--                                       name="toll_cost"--}}
{{--                                       class="form-control cost-input @error('toll_cost') is-invalid @enderror"--}}
{{--                                       value="{{ old('toll_cost', $movement?->toll_cost) }}"--}}
{{--                                       id="toll_cost"--}}
{{--                                       step="0.01"--}}
{{--                                       min="0"--}}
{{--                                       max="999">--}}
{{--                                <label for="toll_cost">{{ __('Pedaggi') }}</label>--}}
{{--                            </div>--}}
{{--                            {!! $errors->first('toll_cost', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Parcheggi --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <span class="input-group-text">€</span>--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="number"--}}
{{--                                       name="parking_cost"--}}
{{--                                       class="form-control cost-input @error('parking_cost') is-invalid @enderror"--}}
{{--                                       value="{{ old('parking_cost', $movement?->parking_cost) }}"--}}
{{--                                       id="parking_cost"--}}
{{--                                       step="0.01"--}}
{{--                                       min="0"--}}
{{--                                       max="999">--}}
{{--                                <label for="parking_cost">{{ __('Parcheggi') }}</label>--}}
{{--                            </div>--}}
{{--                            {!! $errors->first('parking_cost', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Altri Costi --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <span class="input-group-text">€</span>--}}
{{--                            <div class="form-floating">--}}
{{--                                <input type="number"--}}
{{--                                       name="other_costs"--}}
{{--                                       class="form-control cost-input @error('other_costs') is-invalid @enderror"--}}
{{--                                       value="{{ old('other_costs', $movement?->other_costs) }}"--}}
{{--                                       id="other_costs"--}}
{{--                                       step="0.01"--}}
{{--                                       min="0"--}}
{{--                                       max="9999">--}}
{{--                                <label for="other_costs">{{ __('Altri Costi') }}</label>--}}
{{--                            </div>--}}
{{--                            {!! $errors->first('other_costs', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Note Costi --}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="cost_notes"--}}
{{--                                   class="form-control @error('cost_notes') is-invalid @enderror"--}}
{{--                                   value="{{ old('cost_notes', $movement?->cost_notes) }}"--}}
{{--                                   id="cost_notes">--}}
{{--                            <label for="cost_notes">{{ __('Note sui Costi') }}</label>--}}
{{--                            {!! $errors->first('cost_notes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Totale Costi --}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="alert alert-success">--}}
{{--                            <strong>Totale: € <span id="total-cost">0.00</span></strong>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Documenti e Note --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header">--}}
{{--                <i class="bi bi-file-text"></i> Documenti e Note--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- Ordine di Missione --}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <input type="text"--}}
{{--                                   name="mission_order"--}}
{{--                                   class="form-control @error('mission_order') is-invalid @enderror"--}}
{{--                                   value="{{ old('mission_order', $movement?->mission_order) }}"--}}
{{--                                   id="mission_order">--}}
{{--                            <label for="mission_order">{{ __('N° Ordine di Missione') }}</label>--}}
{{--                            {!! $errors->first('mission_order', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Pernottamento --}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-check form-switch mb-3">--}}
{{--                            <input class="form-check-input"--}}
{{--                                   type="checkbox"--}}
{{--                                   name="requires_overnight"--}}
{{--                                   id="requires_overnight"--}}
{{--                                   value="1"--}}
{{--                                   {{ old('requires_overnight', $movement?->requires_overnight) ? 'checked' : '' }}>--}}
{{--                            <label class="form-check-label" for="requires_overnight">--}}
{{--                                Richiede pernottamento--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Luogo Pernottamento --}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-floating mb-3" id="overnight-location-container" style="display: none;">--}}
{{--                            <input type="text"--}}
{{--                                   name="overnight_location"--}}
{{--                                   class="form-control @error('overnight_location') is-invalid @enderror"--}}
{{--                                   value="{{ old('overnight_location', $movement?->overnight_location) }}"--}}
{{--                                   id="overnight_location">--}}
{{--                            <label for="overnight_location">{{ __('Luogo Pernottamento') }}</label>--}}
{{--                            {!! $errors->first('overnight_location', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Note --}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <textarea name="notes"--}}
{{--                                      class="form-control @error('notes') is-invalid @enderror"--}}
{{--                                      id="notes"--}}
{{--                                      style="height: 100px">{{ old('notes', $movement?->notes) }}</textarea>--}}
{{--                            <label for="notes">{{ __('Note Generali') }}</label>--}}
{{--                            {!! $errors->first('notes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Incidenti --}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="form-floating mb-3">--}}
{{--                            <textarea name="incidents"--}}
{{--                                      class="form-control @error('incidents') is-invalid @enderror"--}}
{{--                                      id="incidents"--}}
{{--                                      style="height: 80px">{{ old('incidents', $movement?->incidents) }}</textarea>--}}
{{--                            <label for="incidents">{{ __('Incidenti/Problemi') }}</label>--}}
{{--                            {!! $errors->first('incidents', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Controlli Veicolo --}}
{{--        <div class="card mb-3">--}}
{{--            <div class="card-header">--}}
{{--                <i class="bi bi-check2-square"></i> Controlli Veicolo--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    --}}{{-- Controlli --}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-check mb-3">--}}
{{--                            <input class="form-check-input"--}}
{{--                                   type="checkbox"--}}
{{--                                   name="vehicle_check_before"--}}
{{--                                   id="vehicle_check_before"--}}
{{--                                   value="1"--}}
{{--                                   {{ old('vehicle_check_before', $movement?->vehicle_check_before) ? 'checked' : '' }}>--}}
{{--                            <label class="form-check-label" for="vehicle_check_before">--}}
{{--                                <i class="bi bi-check-circle text-success"></i> Controllo veicolo pre-partenza effettuato--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                        <div class="form-check mb-3">--}}
{{--                            <input class="form-check-input"--}}
{{--                                   type="checkbox"--}}
{{--                                   name="vehicle_check_after"--}}
{{--                                   id="vehicle_check_after"--}}
{{--                                   value="1"--}}
{{--                                   {{ old('vehicle_check_after', $movement?->vehicle_check_after) ? 'checked' : '' }}>--}}
{{--                            <label class="form-check-label" for="vehicle_check_after">--}}
{{--                                <i class="bi bi-check-circle text-success"></i> Controllo veicolo post-arrivo effettuato--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- Danni --}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-floating">--}}
{{--                            <textarea name="vehicle_damages"--}}
{{--                                      class="form-control @error('vehicle_damages') is-invalid @enderror"--}}
{{--                                      id="vehicle_damages"--}}
{{--                                      style="height: 80px"--}}
{{--                                      placeholder="Danni">{{ old('vehicle_damages', $movement?->vehicle_damages) }}</textarea>--}}
{{--                            <label for="vehicle_damages">{{ __('Eventuali Danni Riscontrati') }}</label>--}}
{{--                            {!! $errors->first('vehicle_damages', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Movimento') }}
        </button>
        <a href="{{ route('movements.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

{{-- Script per funzionalità dinamiche --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calcolo KM totali
    const kmStart = document.getElementById('km_start');
    const kmEnd = document.getElementById('km_end');
    const kmTotal = document.getElementById('km_total_display');

    function calculateKm() {
        const start = parseInt(kmStart.value) || 0;
        const end = parseInt(kmEnd.value) || 0;
        if (end > start) {
            kmTotal.value = end - start;
        } else {
            kmTotal.value = '';
        }
    }

    kmStart.addEventListener('input', calculateKm);
    kmEnd.addEventListener('input', calculateKm);

    // Calcolo costi totali
    const costInputs = document.querySelectorAll('.cost-input');
    const totalCost = document.getElementById('total-cost');

    function calculateTotalCost() {
        let total = 0;
        costInputs.forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        totalCost.textContent = total.toFixed(2);
    }

    costInputs.forEach(input => {
        input.addEventListener('input', calculateTotalCost);
    });

    // Conteggio passeggeri
    const passengersSelect = document.getElementById('passengers');
    const externalPassengers = document.getElementById('external_passengers');
    const totalPassengers = document.getElementById('total-passengers');

    function countPassengers() {
        const internal = passengersSelect.selectedOptions.length;
        const external = externalPassengers.value ? externalPassengers.value.split(',').filter(p => p.trim()).length : 0;
        totalPassengers.textContent = internal + external;
    }

    passengersSelect.addEventListener('change', countPassengers);
    externalPassengers.addEventListener('input', countPassengers);

    // Toggle pernottamento
    const requiresOvernight = document.getElementById('requires_overnight');
    const overnightContainer = document.getElementById('overnight-location-container');

    function toggleOvernight() {
        overnightContainer.style.display = requiresOvernight.checked ? 'block' : 'none';
    }

    requiresOvernight.addEventListener('change', toggleOvernight);
    toggleOvernight(); // Init

    // Info veicolo
    const carSelect = document.getElementById('car_id');
    const carInfo = document.getElementById('car-info');

    carSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (selected.value) {
            const brand = selected.dataset.brand || '';
            const type = selected.dataset.type || '';
            const power = selected.dataset.power || '';
            carInfo.innerHTML = `<i class="bi bi-info-circle"></i> ${brand} - ${type} - ${power}`;
        } else {
            carInfo.innerHTML = '';
        }
    });

    // Controllo disponibilità veicolo
    const departureDate = document.getElementById('departure_datetime');
    const arrivalDate = document.getElementById('arrival_datetime');
    const availabilityAlert = document.getElementById('availability-alert');
    const availabilityMessage = document.getElementById('availability-message');

    let checkAvailabilityTimeout;

    function checkAvailability() {
        clearTimeout(checkAvailabilityTimeout);

        if (!carSelect.value || !departureDate.value || !arrivalDate.value) {
            availabilityAlert.classList.add('d-none');
            return;
        }

        checkAvailabilityTimeout = setTimeout(() => {
            fetch('{{ route("movements.checkAvailability") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    car_id: carSelect.value,
                    departure_datetime: departureDate.value,
                    arrival_datetime: arrivalDate.value,
                    exclude_id: {{ $movement?->id ?? 'null' }}
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    availabilityAlert.className = 'alert alert-success';
                    availabilityMessage.textContent = 'Veicolo disponibile nel periodo selezionato.';
                } else {
                    availabilityAlert.className = 'alert alert-danger';
                    let message = 'ATTENZIONE: Veicolo già impegnato in questi periodi:\n';
                    data.conflicts.forEach(conflict => {
                        message += `• ${conflict.code} - ${conflict.driver.name} - ${new Date(conflict.departure_datetime).toLocaleString('it-IT')}\n`;
                    });
                    availabilityMessage.textContent = message;
                }
                availabilityAlert.classList.remove('d-none');
            })
            .catch(error => {
                console.error('Errore controllo disponibilità:', error);
            });
        }, 500);
    }

    carSelect.addEventListener('change', checkAvailability);
    departureDate.addEventListener('change', checkAvailability);
    arrivalDate.addEventListener('change', checkAvailability);

    // Suggerimento ultimo KM
    carSelect.addEventListener('change', function() {
        if (this.value && !kmStart.value) {
            fetch('{{ route("movements.getLastKm") }}?car_id=' + this.value)
                .then(response => response.json())
                .then(data => {
                    if (data.last_km) {
                        kmStart.value = data.last_km;
                        kmStart.classList.add('bg-warning', 'bg-opacity-25');
                        setTimeout(() => {
                            kmStart.classList.remove('bg-warning', 'bg-opacity-25');
                        }, 2000);
                    }
                });
        }
    });

    // Init
    calculateKm();
    calculateTotalCost();
    countPassengers();
    if (carSelect.value) {
        carSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
