<div class="row">
    <div class="col-md-8">
        <!-- Dati Principali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni CIG</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- CIG -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="cig" id="cig"
                                class="form-control @error('cig') is-invalid @enderror"
                                value="{{ old('cig', $cig->cig ?? '') }}"
                                placeholder="ZAB12345"
                                style="text-transform: uppercase;"
                                required>
                            <label for="cig">{{ __('Codice CIG') }} <span class="text-danger">*</span></label>
                            @error('cig')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Data -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', isset($cig) && $cig->date ? $cig->date->format('Y-m-d') : date('Y-m-d')) }}">
                            <label for="date">{{ __('Data CIG') }}</label>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Veicolo -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="car_id" id="car_id" class="form-select @error('car_id') is-invalid @enderror" required>
                                <option value="">Seleziona un veicolo...</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ old('car_id', $cig->car_id ?? '') == $car->id ? 'selected' : '' }}>
                                        {{ $car->name }}
                                        @if($car->carPlates->count() > 0)
                                            - {{ $car->carPlates->first()->name }}
                                        @endif
                                        @if($car->carBrand)
                                            ({{ $car->carBrand->name }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <label for="car_id">{{ __('Veicolo') }} <span class="text-danger">*</span></label>
                            @error('car_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Officina -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="maintenance_garage_id" id="maintenance_garage_id" class="form-select @error('maintenance_garage_id') is-invalid @enderror" required>
                                <option value="">Seleziona un'officina...</option>
                                @foreach($garages as $garage)
                                    <option value="{{ $garage->id }}"
                                        {{ old('maintenance_garage_id', $cig->maintenance_garage_id ?? request('maintenance_garage_id')) == $garage->id ? 'selected' : '' }}
                                        data-car-id="{{ $garage->maintenance->car_id }}">
                                        {{ $garage->name }}
                                        @if($garage->piva)
                                            (P.IVA: {{ $garage->piva }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <label for="maintenance_garage_id">{{ __('Officina') }} <span class="text-danger">*</span></label>
                            @error('maintenance_garage_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- CE -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="ce" id="ce"
                                class="form-control @error('ce') is-invalid @enderror"
                                value="{{ old('ce', $cig->ce ?? '') }}"
                                placeholder="Codice CE">
                            <label for="ce">{{ __('Codice CE (opzionale)') }}</label>
                            @error('ce')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $cig->description ?? '') }}"
                                placeholder="Descrizione servizio">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
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
                        <div class="form-floating">
                            <input type="text" name="taxable" id="taxable"
                                class="form-control @error('taxable') is-invalid @enderror"
                                value="{{ old('taxable', $cig->taxable ?? '') }}"
                                placeholder="0,00">
                            <label for="taxable">{{ __('Imponibile €') }}</label>
                            @error('taxable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- IVA -->
                    <div class="col-md-4 mb-3">
                        <div class="form-floating">
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
                        <div class="form-floating">
                            <input type="text" id="total"
                                class="form-control"
                                value="0,00"
                                readonly>
                            <label for="total">{{ __('Totale €') }}</label>
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
                        <div class="form-floating">
                            <select name="user_rup_id" id="user_rup_id" class="form-select @error('user_rup_id') is-invalid @enderror">
                                <option value="">Seleziona RUP...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_rup_id', $cig->user_rup_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user_rup_id">{{ __('RUP (Responsabile Unico Procedimento)') }}</label>
                            @error('user_rup_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Supporto RUP -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="user_support_id" id="user_support_id" class="form-select @error('user_support_id') is-invalid @enderror">
                                <option value="">Seleziona supporto RUP...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_support_id', $cig->user_support_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user_support_id">{{ __('Supporto RUP') }}</label>
                            @error('user_support_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Responsabile Bando -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="user_tender_notice_id" id="user_tender_notice_id" class="form-select @error('user_tender_notice_id') is-invalid @enderror">
                                <option value="">Seleziona responsabile bando...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_tender_notice_id', $cig->user_tender_notice_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user_tender_notice_id">{{ __('Responsabile Bando') }}</label>
                            @error('user_tender_notice_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Collaudatore -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="user_tester_id" id="user_tester_id" class="form-select @error('user_tester_id') is-invalid @enderror">
                                <option value="">Seleziona collaudatore...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_tester_id', $cig->user_tester_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user_tester_id">{{ __('Collaudatore') }}</label>
                            @error('user_tester_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Documenti -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-folder2-open"></i> Documenti</h5>
            </div>
            <div class="card-body">
                <!-- Preventivo -->
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="preventive" id="preventive"
                            class="form-control @error('preventive') is-invalid @enderror"
                            value="{{ old('preventive', $cig->preventive ?? '') }}"
                            placeholder="Riferimento preventivo">
                        <label for="preventive">{{ __('Preventivo') }}</label>
                        @error('preventive')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Relazione Finale -->
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="final_report" id="final_report"
                            class="form-control @error('final_report') is-invalid @enderror"
                            value="{{ old('final_report', $cig->final_report ?? '') }}"
                            placeholder="Riferimento relazione">
                        <label for="final_report">{{ __('Relazione Finale') }}</label>
                        @error('final_report')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Note -->
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea name="note" id="note"
                            class="form-control @error('note') is-invalid @enderror"
                            style="height: 100px"
                            placeholder="Note aggiuntive...">{{ old('note', $cig->note ?? '') }}</textarea>
                        <label for="note">{{ __('Note') }}</label>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Info CIG -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni CIG</h5>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Cos'è il CIG?</strong></p>
                <p class="small">Il Codice Identificativo Gara (CIG) è un codice alfanumerico univoco obbligatorio per tutti i contratti pubblici di lavori, servizi e forniture.</p>

                <hr>

                <p class="mb-2"><strong>Formato CIG:</strong></p>
                <ul class="small mb-0">
                    <li><strong>Smart CIG:</strong> Z + 2 lettere + 5 numeri</li>
                    <li><strong>CIG ordinario:</strong> 10 caratteri alfanumerici</li>
                </ul>
            </div>
        </div>
    </div>
</div>

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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Genera CIG simulato
    $('#generate-cig').click(function() {
        $.get('/cigs/generate')
            .done(function(response) {
                $('#cig').val(response.cig);
            });
    });

    // Sincronizza veicolo con officina
    $('#maintenance_garage_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var carId = selectedOption.data('car-id');
        if (carId) {
            $('#car_id').val(carId);
        }
    });

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
