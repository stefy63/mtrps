@php($button = $button ?? true)
<div class="row">
    <div class="col-md-8">
        <!-- Dati Principali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Officina</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Manutenzione -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <select name="maintenance_id" id="maintenance_id" class="form-select @error('maintenance_id') is-invalid @enderror" required>
                                <option value="">Seleziona una manutenzione...</option>
                                @foreach($maintenances as $maintenance)
                                    <option value="{{ $maintenance->id }}"
                                        {{ old('maintenance_id', $maintenanceGarage->maintenance_id ?? request('maintenance_id')) == $maintenance->id ? 'selected' : '' }}>
                                        {{ $maintenance->car->name }}
                                        @if($maintenance->car->carPlates->count() > 0)
                                            ({{ $maintenance->car->carPlates->first()->name }})
                                        @endif
                                        - {{ $maintenance->name }} - {{ $maintenance->date_from->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="maintenance_id">{{ __('Manutenzione') }} <span class="text-danger">*</span></label>
                            @error('maintenance_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nome Officina -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $maintenanceGarage->name ?? '') }}"
                                placeholder="Es: Officina Autorizzata Fiat"
                                required>
                            <label for="name">{{ __('Nome Officina') }} <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="name-suggestions" class="mt-2"></div>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $maintenanceGarage->description ?? '') }}"
                                placeholder="Es: Specializzata in veicoli commerciali">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dati Fiscali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Dati Fiscali</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- P.IVA -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="piva" id="piva"
                                class="form-control @error('piva') is-invalid @enderror"
                                value="{{ old('piva', $maintenanceGarage->piva ?? '') }}"
                                placeholder="12345678901"
                                maxlength="11">
                            <label for="piva">{{ __('Partita IVA') }}</label>
                            @error('piva')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="piva-validation" class="mt-1"></div>
                    </div>

                    <!-- Codice Fiscale -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="cf" id="cf"
                                class="form-control @error('cf') is-invalid @enderror"
                                value="{{ old('cf', $maintenanceGarage->cf ?? '') }}"
                                placeholder="RSSMRA85M01H501Z"
                                maxlength="16"
                                style="text-transform: uppercase;">
                            <label for="cf">{{ __('Codice Fiscale') }}</label>
                            @error('cf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- IBAN -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="iban" id="iban"
                                class="form-control @error('iban') is-invalid @enderror"
                                value="{{ old('iban', $maintenanceGarage->iban ?? '') }}"
                                placeholder="IT60X0542811101000000123456"
                                maxlength="27"
                                style="text-transform: uppercase;">
                            <label for="iban">{{ __('IBAN') }}</label>
                            @error('iban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Formato: IT + 2 cifre + 1 lettera + 22 cifre</small>
                    </div>

                    <!-- PEC -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="email" name="pec" id="pec"
                                class="form-control @error('pec') is-invalid @enderror"
                                value="{{ old('pec', $maintenanceGarage->pec ?? '') }}"
                                placeholder="officina@pec.it">
                            <label for="pec">{{ __('PEC (Posta Elettronica Certificata)') }}</label>
                            @error('pec')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="pec-suggestions" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certificazioni -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-shield-check"></i> Certificazioni e Documenti</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Accreditamento -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('Accreditamento') }} <span class="text-danger">*</span></label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="acc" id="acc_yes" value="yes"
                                {{ old('acc', $maintenanceGarage->acc ?? 'no') == 'yes' ? 'checked' : '' }} required>
                            <label class="btn btn-outline-success" for="acc_yes">
                                <i class="bi bi-check-circle"></i> Sì
                            </label>

                            <input type="radio" class="btn-check" name="acc" id="acc_no" value="no"
                                {{ old('acc', $maintenanceGarage->acc ?? 'no') == 'no' ? 'checked' : '' }} required>
                            <label class="btn btn-outline-secondary" for="acc_no">
                                <i class="bi bi-x-circle"></i> No
                            </label>
                        </div>
                        @error('acc')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Certificazione Antimafia -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('Certificazione Antimafia') }} <span class="text-danger">*</span></label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="anti_mafia" id="anti_mafia_yes" value="yes"
                                {{ old('anti_mafia', $maintenanceGarage->anti_mafia ?? 'no') == 'yes' ? 'checked' : '' }} required>
                            <label class="btn btn-outline-success" for="anti_mafia_yes">
                                <i class="bi bi-shield-check"></i> Sì
                            </label>

                            <input type="radio" class="btn-check" name="anti_mafia" id="anti_mafia_no" value="no"
                                {{ old('anti_mafia', $maintenanceGarage->anti_mafia ?? 'no') == 'no' ? 'checked' : '' }} required>
                            <label class="btn btn-outline-secondary" for="anti_mafia_no">
                                <i class="bi bi-shield-x"></i> No
                            </label>
                        </div>
                        @error('anti_mafia')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DURC -->
                    <div class="col-md-4 mb-3">
                        <div class="form-floating">
                            <input type="date" name="durc" id="durc"
                                class="form-control @error('durc') is-invalid @enderror"
                                value="{{ old('durc', isset($maintenanceGarage) && $maintenanceGarage->durc ? $maintenanceGarage->durc->format('Y-m-d') : '') }}">
                            <label for="durc">{{ __('Scadenza DURC') }}</label>
                            @error('durc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="durc-alert" class="mt-1"></div>
                    </div>
                </div>

                <!-- Note -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                class="form-control @error('note') is-invalid @enderror"
                                style="height: 100px"
                                placeholder="Note aggiuntive...">{{ old('note', $maintenanceGarage->note ?? '') }}</textarea>
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

    <div class="col-md-4">
        <!-- Anteprima -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-eye"></i> Anteprima</h5>
            </div>
            <div class="card-body">
                <div id="preview-content">
                    <p class="text-muted text-center">
                        <i class="bi bi-arrow-left"></i> Compila i campi per vedere l'anteprima
                    </p>
                </div>
            </div>
        </div>

        <!-- Suggerimenti -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-lightbulb"></i> Suggerimenti</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Verifica sempre P.IVA e CF dell'officina</li>
                    <li>L'accreditamento è importante per PA</li>
                    <li>La certificazione antimafia è obbligatoria per importi elevati</li>
                    <li>Controlla la scadenza del DURC regolarmente</li>
                    <li>Conserva tutti i documenti in formato digitale</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Officina') }}
        </button>
        <a href="{{ route('maintenance-garages.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Carica suggerimenti nome
    loadNameSuggestions();

    function loadNameSuggestions() {
        $.get('/maintenance-garages/suggestions', { type: 'name' })
            .done(function(suggestions) {
                if (suggestions.length > 0) {
                    var html = '<small class="text-muted">Suggerimenti: ';
                    suggestions.forEach(function(suggestion, index) {
                        if (index > 0 && index % 3 === 0) html += '<br>';
                        if (index > 0 && index % 3 !== 0) html += ' | ';
                        html += '<a href="#" class="suggestion-link-name text-decoration-none">' + suggestion + '</a>';
                    });
                    html += '</small>';
                    $('#name-suggestions').html(html);
                }
            });
    }

    // Click sui suggerimenti nome
    $(document).on('click', '.suggestion-link-name', function(e) {
        e.preventDefault();
        $('#name').val($(this).text());
        updatePreview();
    });

    // Suggerimenti PEC
    $('#pec').on('input', function() {
        var value = $(this).val();
        if (value.includes('@')) return;

        $.get('/maintenance-garages/suggestions', { type: 'pec' })
            .done(function(suggestions) {
                if (suggestions.length > 0) {
                    var html = '<small class="text-muted">Domini comuni: ';
                    suggestions.forEach(function(domain, index) {
                        if (index > 0) html += ' | ';
                        html += '<a href="#" class="pec-domain text-decoration-none">' + domain + '</a>';
                    });
                    html += '</small>';
                    $('#pec-suggestions').html(html);
                }
            });
    });

    // Click sui domini PEC
    $(document).on('click', '.pec-domain', function(e) {
        e.preventDefault();
        var currentValue = $('#pec').val();
        if (!currentValue.includes('@')) {
            $('#pec').val(currentValue + $(this).text());
            updatePreview();
        }
    });

    // Validazione P.IVA in tempo reale
    $('#piva').on('input', function() {
        var piva = $(this).val();
        if (piva.length === 11) {
            $.get('/maintenance-garages/validate-piva', { piva: piva })
                .done(function(response) {
                    if (response.valid) {
                        $('#piva-validation').html('<small class="text-success"><i class="bi bi-check-circle"></i> ' + response.message + '</small>');
                    } else {
                        $('#piva-validation').html('<small class="text-danger"><i class="bi bi-x-circle"></i> ' + response.message + '</small>');
                    }
                });
        } else {
            $('#piva-validation').empty();
        }
    });

    // Controllo scadenza DURC
    $('#durc').change(function() {
        var durcDate = new Date($(this).val());
        var today = new Date();
        var diffTime = durcDate - today;
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays < 0) {
            $('#durc-alert').html('<small class="text-danger"><i class="bi bi-exclamation-triangle"></i> DURC scaduto da ' + Math.abs(diffDays) + ' giorni</small>');
        } else if (diffDays <= 30) {
            $('#durc-alert').html('<small class="text-warning"><i class="bi bi-exclamation-triangle"></i> DURC in scadenza tra ' + diffDays + ' giorni</small>');
        } else {
            $('#durc-alert').html('<small class="text-success"><i class="bi bi-check-circle"></i> DURC valido per ' + diffDays + ' giorni</small>');
        }
        updatePreview();
    });

    // Aggiorna anteprima
    function updatePreview() {
        var maintenance = $('#maintenance_id option:selected').text();
        var name = $('#name').val();
        var piva = $('#piva').val();
        var cf = $('#cf').val();
        var pec = $('#pec').val();
        var acc = $('input[name="acc"]:checked').val();
        var antiMafia = $('input[name="anti_mafia"]:checked').val();
        var durc = $('#durc').val();

        if (maintenance && name) {
            var html = '<div class="border rounded p-3">';
            html += '<h6 class="mb-2"><i class="bi bi-building"></i> ' + name + '</h6>';
            html += '<p class="mb-1"><small><strong>Manutenzione:</strong> ' + maintenance + '</small></p>';

            if (piva || cf) {
                html += '<p class="mb-1"><small><strong>Dati fiscali:</strong>';
                if (piva) html += ' P.IVA ' + piva;
                if (cf) html += (piva ? ' - ' : ' ') + 'CF ' + cf;
                html += '</small></p>';
            }

            if (pec) {
                html += '<p class="mb-1"><small><strong>PEC:</strong> ' + pec + '</small></p>';
            }

            html += '<div class="mt-2">';
            if (acc === 'yes') {
                html += '<span class="badge bg-success me-1"><i class="bi bi-check-circle"></i> Accreditata</span>';
            }
            if (antiMafia === 'yes') {
                html += '<span class="badge bg-success me-1"><i class="bi bi-shield-check"></i> Antimafia OK</span>';
            }
            if (durc) {
                html += '<span class="badge bg-info"><i class="bi bi-calendar-check"></i> DURC</span>';
            }
            html += '</div>';

            html += '</div>';

            $('#preview-content').html(html);
        } else {
            $('#preview-content').html('<p class="text-muted text-center"><i class="bi bi-arrow-left"></i> Compila i campi per vedere l\'anteprima</p>');
        }
    }

    // Eventi per aggiornare anteprima
    $('#maintenance_id, #name, #piva, #cf, #pec, #iban').on('input change', updatePreview);
    $('input[name="acc"], input[name="anti_mafia"]').change(updatePreview);

    // Uppercase automatico per CF e IBAN
    $('#cf, #iban').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Solo numeri per P.IVA
    $('#piva').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
    });
});
</script>
@endpush
