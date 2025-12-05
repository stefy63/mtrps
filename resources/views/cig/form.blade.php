@php($button = $button ?? true)
<div class="row">
    <div class="col-md-12">
        <!-- Dati Principali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni CIG</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- CIG -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="cig">{{ __('Codice CIG') }} <span class="text-danger">*</span></label>
                            <input type="text" name="cig" id="cig"
                                class="form-control @error('cig') is-invalid @enderror"
                                value="{{ old('cig', $cig->cig ?? '') }}"
                                placeholder="ZAB12345"
                                style="text-transform: uppercase;"
                                required>
                            @error('cig')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Data -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <x-datetime-picker
                                    label="Data CIG"
                                    name="date"
                                    value="{{ old('date', $cig?->date?->format('Y-m-d')) }}"
                                    type="date"
                            />
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Veicolo -->
                    <div class="col-md-6 mb-3">
                        <x-dynamic-select
                            disabled="{{ !$button }}"
                            name="car_id"
                            :required="true"
                            :value="old('car_id', $cig->car_id ?? '')"
                            :options="$cars"
                            :errors="$errors"
                            endpoint="{{ route('car.storeForm') }}"
                            label="{{ __('Veicolo') }}"
                            labelKey="full_name"
                            idKey="id"
                            modal-url="{{ route('car.getForm') }}"
                            modal-title="Nuovo veicolo"
                            modalClass="modal-xl"
                        />
                    </div>

                    <!-- Officina -->
                    <div class="col-md-6 mb-3">
                        <x-dynamic-select
                            disabled="{{ !$button }}"
                            name="maintenance_garage_id"
                            :required="true"
                            :value="old('maintenance_garage_id', $cig->maintenance_garage_id ?? '')"
                            :options="$garages"
                            :errors="$errors"
                            endpoint="{{ route('maintenance-garage.storeForm') }}"
                            label="{{ __('Officina') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('maintenance-garage.getForm') }}"
                            modal-title="Nuova officina"
                            modalClass="modal-xl"
                        />
                    </div>

                    <!-- CE -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="ce">{{ __('Codice CE (opzionale)') }}</label>
                            <input type="text" name="ce" id="ce"
                                class="form-control @error('ce') is-invalid @enderror"
                                value="{{ old('ce', $cig->ce ?? '') }}"
                                placeholder="Codice CE">
                            @error('ce')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="description">{{ __('Descrizione (opzionale)') }}</label>
                            <input type="text" name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $cig->description ?? '') }}"
                                placeholder="Descrizione servizio">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Importi -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-currency-euro"></i> Importi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Imponibile -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="taxable">{{ __('Imponibile €') }}</label>
                            <input type="text" name="taxable" id="taxable"
                                class="form-control @error('taxable') is-invalid @enderror"
                                value="{{ old('taxable', $cig->taxable ?? '') }}"
                                placeholder="0,00">
                            @error('taxable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- IVA -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="vat">{{ __('IVA € (22%)') }}</label>
                            <input type="text" name="vat" id="vat"
                                class="form-control @error('vat') is-invalid @enderror"
                                value="{{ old('vat', $cig->vat ?? '') }}"
                                placeholder="0,00"
                                readonly>
                            <label for="vat">{{ __('IVA € (22%)') }}</label>
                            @error('vat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Totale -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="total">{{ __('Totale €') }}</label>
                            <input type="text" id="total"
                                class="form-control"
                                value="0,00"
                                readonly>
                            @error('total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsabili -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-people"></i> Responsabili</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- RUP -->
                    <div class="col-md-6 mb-3">


                        <x-dynamic-select
                            name="user_rup_id"
                            :value="old('user_rup_id', $cig->user_rup_id ?? '')"
                            :options="$users"
                            :errors="$errors"
                            endpoint="{{ route('users.storeForm') }}"
                            label="{{ __('RUP') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('users.getForm') }}"
                            modal-title="Nuovo utente"
                            modalClass="modal-lg"
                        />
                    </div>

                    <!-- Supporto RUP -->
                    <div class="col-md-6 mb-3">
                        <x-dynamic-select
                            name="user_support_id"
                            :value="old('user_support_id', $cig->user_support_id ?? '')"
                            :options="$users"
                            :errors="$errors"
                            endpoint="{{ route('users.storeForm') }}"
                            label="{{ __('Supporto RUP') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('users.getForm') }}"
                            modal-title="Nuovo utente"
                            modalClass="modal-lg"
                        />
                    </div>

                    <!-- Responsabile Bando -->
                    <div class="col-md-6 mb-3">
                        <x-dynamic-select
                            name="user_tender_notice_id"
                            :value="old('user_tender_notice_id', $cig->user_tender_notice_id ?? '')"
                            :options="$users"
                            :errors="$errors"
                            endpoint="{{ route('users.storeForm') }}"
                            label="{{ __('Responsabile Bando') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('users.getForm') }}"
                            modal-title="Nuovo utente"
                            modalClass="modal-lg"
                        />
                    </div>

                    <!-- Collaudatore -->
                    <div class="col-md-6 mb-3">
                        <x-dynamic-select
                            name="user_tester_id"
                            :value="old('user_tester_id', $cig->user_tester_id ?? '')"
                            :options="$users"
                            :errors="$errors"
                            endpoint="{{ route('users.storeForm') }}"
                            label="{{ __('Collaudatore') }}"
                            labelKey="name"
                            idKey="id"
                            modal-url="{{ route('users.getForm') }}"
                            modal-title="Nuovo utente"
                            modalClass="modal-lg"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@if ($button)
<div class="row mt-3">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva CIG') }}
        </button>
        <a href="{{ route('cigs.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>
@endif
@push('scripts')
<script type="module">
$(document).ready(function() {

    // Calcolo automatico IVA e totale
    $('#taxable').on('input', function() {
        var taxable = parseFloat($(this).val().replace(',', '.')) || 0;
        var vat = taxable * 0.22;
        var total = taxable + vat;

        $('#vat').val(vat.toFixed(2).replace('.', ','));
        $('#total').val(total.toFixed(2).replace('.', ','));
    });

    // Uppercase automatico per CIG
    $('#cig').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Trigger calcolo iniziale
    $('#taxable').trigger('input');
});
</script>
@endpush
