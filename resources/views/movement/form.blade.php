@php($button = $button ?? true)
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
                    <div class="col-md-6">
                        <x-dynamic-select
                                name="car_id"
                                modalClass="modal-xl"
                                :required="'true'"
                                :value="old('car_id', $movement?->car_id)"
                                :options="$cars"
                                :errors="$errors"
                                endpoint="{{ route('car.storeForm') }}"
                                label="{{ __('Veicolo') }}"
                                labelKey="full_name"
                                idKey="id"
                                modal-url="{{ route('car.getForm') }}"
                                modal-title="Nuova Vettura"
                        />
{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="car_id"--}}
{{--                                    class="form-select @error('car_id') is-invalid @enderror"--}}
{{--                                    id="car_id"--}}
{{--                                    required>--}}
{{--                                <option value="">Seleziona veicolo...</option>--}}
{{--                                @foreach($cars as $car)--}}
{{--                                    <option value="{{ $car->id }}"--}}
{{--                                            {{ old('car_id', $movement?->car_id) == $car->id ? 'selected' : '' }}--}}
{{--                                            data-brand="{{ $car->carBrand?->name }}"--}}
{{--                                            data-type="{{ $car->carType?->name }}"--}}
{{--                                            data-power="{{ $car->carPower?->name }}">--}}
{{--                                        {{ $car->name }}--}}
{{--                                        @if($car->carPlates->first())--}}
{{--                                            {{ $car->carBrand?->name }} - {{ $car->carPlates->first()->name }}--}}
{{--                                        @endif--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="car_id">{{ __('Veicolo') }} *</label>--}}
{{--                            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <div id="car-info" class="mt-2 text-muted small"></div>--}}
{{--                        </div>--}}
                    </div>



                    <div class="col-md-5">

                        <x-dynamic-select
                                name="office_id"
                                :required="'true'"
                                :value="old('office_id', $movement?->office_id)"
                                :options="$offices"
                                :errors="$errors"
                                endpoint="{{ route('car.storeForm') }}"
                                label="{{ __('Ufficio Destinatario') }}"
                                labelKey="full_name"
                                idKey="id"
                                modal-url="{{ route('car.getForm') }}"
                                modal-title="Nuova Vettura"
                        />


{{--                        <div class="form-floating mb-3">--}}
{{--                            <select name="car_id"--}}
{{--                                    class="form-select @error('car_id') is-invalid @enderror"--}}
{{--                                    id="car_id"--}}
{{--                                    required>--}}
{{--                                <option value="">Seleziona veicolo...</option>--}}
{{--                                @foreach($cars as $car)--}}
{{--                                    <option value="{{ $car->id }}"--}}
{{--                                            {{ old('car_id', $movement?->car_id) == $car->id ? 'selected' : '' }}--}}
{{--                                            data-brand="{{ $car->carBrand?->name }}"--}}
{{--                                            data-type="{{ $car->carType?->name }}"--}}
{{--                                            data-power="{{ $car->carPower?->name }}">--}}
{{--                                        {{ $car->name }}--}}
{{--                                        @if($car->carPlates->first())--}}
{{--                                            {{ $car->carBrand?->name }} - {{ $car->carPlates->first()->name }}--}}
{{--                                        @endif--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="car_id">{{ __('Veicolo') }} *</label>--}}
{{--                            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--                            <div id="car-info" class="mt-2 text-muted small"></div>--}}
{{--                        </div>--}}
                    </div>

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
                            <input type="date"
                                   name="date_from"
                                   class="form-control @error('date_from') is-invalid @enderror"
                                   value="{{ old('date_from', $movement?->date_from?->format('Y-m-d')) }}"
                                   id="departure_datetime"
                                   required>
                            <label for="departure_datetime">{{ __('Partenza Prevista') }} *</label>
                            {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Arrivo Previsto --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date"
                                   name="date_to"
                                   class="form-control @error('date_to') is-invalid @enderror"
                                   value="{{ old('date_to', $movement?->date_to?->format('Y-m-d')) }}"
                                   id="arrival_datetime">
                            <label for="arrival_datetime">{{ __('Arrivo Previsto') }} *</label>
                            {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

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
