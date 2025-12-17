@php($button = $button ?? true)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Veicolo -->
                    <x-dynamic-select
                            name="car_id"
                            :required="true"
                            disabled="{{!$button}}"
                            :value="old('car_id', $maintenance?->car_id)"
                            :options="$cars"
                            :errors="$errors"
                            modal-class="modal-xl "
                            endpoint="{{ route('car.storeForm') }}"
                            label="{{ __('Veicolo') }}"
                            labelKey="full_name"
                            idKey="id"
                            modal-url="{{ route('car.getForm') }}"
                            modal-title="Nuova Vettura"
                    />
                </div>

                <div class="row mb-3">
                    <x-dynamic-select
                            name="garage_id"
                            :required="true"
                            :value="old('garage_id', $maintenance?->garage_id)"
                            :options="$garages"
                            :errors="$errors"
                            modal-class="modal-xl"
                            endpoint="{{ route('maintenance-garage.storeForm') }}"
                            label="{{ __('Officina') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('maintenance-garage.getForm') }}"
                            modal-title="Nuova Officina"
                    />
                </div>

                <div class="row mb-3">
                    <x-dynamic-select
                            name="type_id"
                            :required="false"
                            :value="old('type_id', $maintenance?->type_id)"
                            :options="$types"
                            :errors="$errors"
                            endpoint="{{ route('maintenance-type.storeForm') }}"
                            label="{{ __('Tipologia') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('maintenance-type.getForm') }}"
                            modal-title="Nuova Tipologia"
                    />
                </div>

                <div class="row mb-3">
                    <div class="">
                        <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                        <input type="text" name="description" id="description"
                               class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description', $maintenance->description ?? '') }}"
                               placeholder="Es: Cambio olio, filtri e controllo generale">
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="description-suggestions" class="mt-2"></div>
                </div>
                <div class="row mb-3">
                    <!-- Data Inizio -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="date_from" id="date_from"
                                   class="form-control @error('date_from') is-invalid @enderror"
                                   value="{{ old('date_from', isset($maintenance) && $maintenance->date_from ? $maintenance->date_from->format('Y-m-d') : date('Y-m-d')) }}"
                                   required>
                            <label for="date_from">{{ __('Data Inizio') }} <span class="text-danger">*</span></label>
                            @error('date_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Data Fine -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="date_to" id="date_to"
                                   class="form-control @error('date_to') is-invalid @enderror"
                                   value="{{ old('date_to', isset($maintenance) && $maintenance->date_to ? $maintenance->date_to->format('Y-m-d') : '') }}">
                            <label for="date_to">{{ __('Data Fine (opzionale)') }}</label>
                            @error('date_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Lascia vuoto se la manutenzione è ancora in corso</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Note -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                      class="form-control @error('note') is-invalid @enderror"
                                      style="height: 100px"
                                      placeholder="Note aggiuntive...">{{ old('note', $maintenance->note ?? '') }}</textarea>
                            <label for="note">{{ __('Note (opzionale)') }}</label>
                            @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($button)
        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ __('Salva Manutenzione') }}
                </button>
                <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
                </a>
            </div>
        </div>
    @endif
</div>
