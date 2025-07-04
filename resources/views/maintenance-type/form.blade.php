<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Intervento</h5>
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
                                        {{ old('maintenance_id', $maintenanceType->maintenance_id ?? request('maintenance_id')) == $maintenance->id ? 'selected' : '' }}>
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

                    <!-- Tipo Intervento -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $maintenanceType->name ?? '') }}"
                                placeholder="Es: Cambio Olio Motore"
                                required>
                            <label for="name">{{ __('Tipo Intervento') }} <span class="text-danger">*</span></label>
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
                                value="{{ old('description', $maintenanceType->description ?? '') }}"
                                placeholder="Es: Cambio olio motore 5W30 e filtro olio">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                class="form-control @error('note') is-invalid @enderror"
                                style="height: 100px"
                                placeholder="Note aggiuntive...">{{ old('note', $maintenanceType->note ?? '') }}</textarea>
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
        <!-- Categorie Interventi -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-check"></i> Categorie Interventi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-sm btn-outline-primary category-btn" data-category="general">
                        <i class="bi bi-wrench"></i> Generale
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary category-btn" data-category="motore">
                        <i class="bi bi-gear"></i> Motore
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger category-btn" data-category="freni">
                        <i class="bi bi-sign-stop"></i> Freni
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-warning category-btn" data-category="sospensioni">
                        <i class="bi bi-arrows-expand"></i> Sospensioni
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info category-btn" data-category="impianto_elettrico">
                        <i class="bi bi-lightning"></i> Impianto Elettrico
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info category-btn" data-category="climatizzazione">
                        <i class="bi bi-snow"></i> Climatizzazione
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-dark category-btn" data-category="pneumatici">
                        <i class="bi bi-circle"></i> Pneumatici
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary category-btn" data-category="trasmissione">
                        <i class="bi bi-gear-wide-connected"></i> Trasmissione
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-success category-btn" data-category="carrozzeria">
                        <i class="bi bi-palette"></i> Carrozzeria
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-dark category-btn" data-category="scarico">
                        <i class="bi bi-wind"></i> Scarico
                    </button>
                </div>
            </div>
        </div>

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
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Tipo Intervento') }}
        </button>
        <a href="{{ route('maintenance-types.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var selectedInterventions = [];

    // Click sui pulsanti categoria
    $('.category-btn').click(function() {
        var category = $(this).data('category');
        loadCategorySuggestions(category);
    });

    // Carica suggerimenti per categoria
    function loadCategorySuggestions(category) {
        $.get('/maintenance-types/suggestions', { category: category })
            .done(function(suggestions) {
                if (suggestions.length > 0) {
                    var html = '<div class="mt-2"><small class="text-muted">Seleziona uno o più interventi:</small><br>';
                    html += '<div class="intervention-checkboxes">';
                    suggestions.forEach(function(suggestion) {
                        var checked = selectedInterventions.includes(suggestion) ? 'checked' : '';
                        html += '<div class="form-check">';
                        html += '<input class="form-check-input intervention-check" type="checkbox" value="' + suggestion + '" ' + checked + '>';
                        html += '<label class="form-check-label">' + suggestion + '</label>';
                        html += '</div>';
                    });
                    html += '</div>';
                    html += '<button type="button" class="btn btn-sm btn-primary mt-2" id="apply-interventions">Applica Selezione</button>';
                    html += '</div>';
                    $('#name-suggestions').html(html);

                    // Evidenzia il pulsante categoria attivo
                    $('.category-btn').removeClass('active');
                    $('.category-btn[data-category="' + category + '"]').addClass('active');
                }
            });
    }

    // Gestione checkbox interventi
    $(document).on('change', '.intervention-check', function() {
        var value = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedInterventions.includes(value)) {
                selectedInterventions.push(value);
            }
        } else {
            selectedInterventions = selectedInterventions.filter(item => item !== value);
        }
    });

    // Applica selezione interventi
    $(document).on('click', '#apply-interventions', function() {
        if (selectedInterventions.length > 0) {
            // Se c'è un solo intervento, mettilo nel campo name
            if (selectedInterventions.length === 1) {
                $('#name').val(selectedInterventions[0]);
            } else {
                // Se ci sono più interventi, metti il primo nel name e gli altri nella descrizione
                $('#name').val('Interventi Multipli');
                $('#description').val(selectedInterventions.join(', '));
            }
            updatePreview();
        }
    });

    // Click diretto su un suggerimento (per selezione singola rapida)
    $(document).on('click', '.form-check-label', function(e) {
        if (!$(e.target).is('input')) {
            var checkbox = $(this).prev('.form-check-input');
            checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
        }
    });

    // Aggiorna anteprima
    function updatePreview() {
        var maintenance = $('#maintenance_id option:selected').text();
        var name = $('#name').val();
        var description = $('#description').val();

        if (maintenance && name) {
            // Determina categoria e icona
            var category = 'Altro';
            var categoryIcon = 'wrench';
            var categoryColor = 'secondary';

            var nameLower = name.toLowerCase();

            if (nameLower.includes('olio') || nameLower.includes('motore') || nameLower.includes('filtro')) {
                category = 'Motore';
                categoryIcon = 'gear';
                categoryColor = 'primary';
            } else if (nameLower.includes('freni') || nameLower.includes('pastigli')) {
                category = 'Freni';
                categoryIcon = 'sign-stop';
                categoryColor = 'danger';
            } else if (nameLower.includes('sospensi') || nameLower.includes('ammortiz')) {
                category = 'Sospensioni';
                categoryIcon = 'arrows-expand';
                categoryColor = 'warning';
            }
            // ... altre categorie ...

            var html = '<div class="border rounded p-3">';
            html += '<h6 class="mb-2"><i class="bi bi-tools"></i> ' + name + '</h6>';
            html += '<span class="badge bg-' + categoryColor + ' mb-2"><i class="bi bi-' + categoryIcon + '"></i> ' + category + '</span>';
            html += '<p class="mb-1"><small><strong>Manutenzione:</strong> ' + maintenance + '</small></p>';

            if (description) {
                html += '<p class="mb-0"><small><strong>Descrizione:</strong> ' + description + '</small></p>';
            }

            if (selectedInterventions.length > 1) {
                html += '<hr class="my-2">';
                html += '<small class="text-muted">Interventi inclusi: ' + selectedInterventions.length + '</small>';
            }

            html += '</div>';

            $('#preview-content').html(html);
        } else {
            $('#preview-content').html('<p class="text-muted text-center"><i class="bi bi-arrow-left"></i> Compila i campi per vedere l\'anteprima</p>');
        }
    }

    // Eventi per aggiornare anteprima
    $('#maintenance_id, #name, #description').on('input change', updatePreview);

    // Carica suggerimenti generali all'inizio
    loadCategorySuggestions('general');
});
</script>
@endpush
