<div class="row padding-1 p-1">
    <div class="col-md-8">
        {{-- Categorie di allestimento --}}
        <div class="mb-4">
            <label class="form-label">Categoria Allestimento</label>
            <div class="row g-2">
                @foreach($categories as $key => $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card category-card h-100" data-category="{{ $key }}" style="cursor: pointer;">
                            <div class="card-body text-center">
                                <i class="bi bi-{{ $category['icon'] }} fs-3 text-{{ $category['color'] }}"></i>
                                <h6 class="mt-2 mb-0">{{ $category['name'] }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Form principale --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="car_id" id="car_id"
                            class="form-control @error('car_id') is-invalid @enderror">
                        <option value="">-- Seleziona Veicolo --</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}"
                                    data-type-id="{{ $car->car_type_id }}"
                                    {{ old('car_id', $carSetup?->car_id) == $car->id ? 'selected' : '' }}>
                                {{ $car->name }}
                                @if($car->carPlates->first())
                                    - {{ $car->carPlates->first()->name }}
                                @endif
                                @if($car->carType)
                                    ({{ $car->carType->name }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <label for="car_id" class="form-label">{{ __('Veicolo') }} *</label>
                    {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $carSetup?->name) }}"
                           placeholder="Nome allestimento"
                           list="setup-suggestions">
                    <label for="name" class="form-label">{{ __('Nome Allestimento') }} *</label>
                    {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <datalist id="setup-suggestions"></datalist>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <textarea name="description"
                              id="description"
                              class="form-control @error('description') is-invalid @enderror"
                              style="height: 80px"
                              placeholder="Descrizione">{{ old('description', $carSetup?->description) }}</textarea>
                    <label for="description" class="form-label">{{ __('Descrizione') }}</label>
                    {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date"
                           name="date_from"
                           id="date_from"
                           class="form-control @error('date_from') is-invalid @enderror"
                           value="{{ old('date_from', $carSetup?->date_from?->format('Y-m-d') ?? date('Y-m-d')) }}"
                           max="{{ date('Y-m-d') }}">
                    <label for="date_from" class="form-label">{{ __('Data Inizio') }} *</label>
                    {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date"
                           name="date_to"
                           id="date_to"
                           class="form-control @error('date_to') is-invalid @enderror"
                           value="{{ old('date_to', $carSetup?->date_to?->format('Y-m-d')) }}">
                    <label for="date_to" class="form-label">{{ __('Data Fine') }}</label>
                    {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    <small class="text-muted">Lasciare vuoto se l'allestimento è ancora attivo</small>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <textarea name="note"
                              id="note"
                              class="form-control @error('note') is-invalid @enderror"
                              style="height: 100px"
                              placeholder="Note">{{ old('note', $carSetup?->note) }}</textarea>
                    <label for="note" class="form-label">{{ __('Note') }}</label>
                    {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>

        {{-- Alert conflitti --}}
        <div id="conflict-alert" class="alert alert-warning d-none">
            <i class="bi bi-exclamation-triangle"></i>
            <span id="conflict-message"></span>
        </div>
    </div>

    {{-- Sidebar suggerimenti --}}
    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-lightbulb"></i> Suggerimenti Allestimenti
                </h6>
            </div>
            <div class="card-body">
                <div id="suggestions-container">
                    <p class="text-muted">Seleziona un veicolo per visualizzare i suggerimenti basati sul tipo.</p>
                </div>
            </div>
        </div>

        {{-- Preview --}}
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-eye"></i> Anteprima
                </h6>
            </div>
            <div class="card-body">
                <div id="preview-container">
                    <div class="text-muted">
                        <p>Compila il form per visualizzare l'anteprima</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> {{ __('Salva') }}
    </button>
    <a href="{{ route('car-setups.index') }}" class="btn btn-secondary">
        <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
    </a>
</div>

@push('styles')
<style>
    .category-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .category-card.selected {
        border-color: var(--bs-primary);
        background-color: var(--bs-primary-bg-subtle);
    }

    .suggestion-item {
        cursor: pointer;
        padding: 8px;
        margin-bottom: 4px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .suggestion-item:hover {
        background-color: var(--bs-gray-200);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carSelect = document.getElementById('car_id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');
    const noteInput = document.getElementById('note');
    const suggestionsContainer = document.getElementById('suggestions-container');
    const setupSuggestions = document.getElementById('setup-suggestions');
    const conflictAlert = document.getElementById('conflict-alert');
    const conflictMessage = document.getElementById('conflict-message');
    const previewContainer = document.getElementById('preview-container');
    const categoryCards = document.querySelectorAll('.category-card');

    let selectedCategory = null;
    let currentSuggestions = [];

    // Gestione selezione categoria
    categoryCards.forEach(card => {
        card.addEventListener('click', function() {
            categoryCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            selectedCategory = this.dataset.category;

            // Filtra suggerimenti per categoria
            if (currentSuggestions.length > 0) {
                filterSuggestionsByCategory(selectedCategory);
            }
        });
    });

    // Carica suggerimenti quando cambia il veicolo
    carSelect.addEventListener('change', function() {
        const carId = this.value;

        if (!carId) {
            suggestionsContainer.innerHTML = '<p class="text-muted">Seleziona un veicolo per visualizzare i suggerimenti.</p>';
            setupSuggestions.innerHTML = '';
            return;
        }

        // Carica suggerimenti via AJAX
        fetch(`{{ route('car-setups.suggestions') }}?car_id=${carId}`)
            .then(response => response.json())
            .then(data => {
                currentSuggestions = data;
                displaySuggestions(data);
                updateDatalist(data);
            });

        // Controlla conflitti
        checkConflicts();
    });

    // Funzione per filtrare suggerimenti per categoria
    function filterSuggestionsByCategory(category) {
        const filtered = category ?
            currentSuggestions.filter(s => s.category === category) :
            currentSuggestions;
        displaySuggestions(filtered);
    }

    // Mostra suggerimenti
    function displaySuggestions(suggestions) {
        if (suggestions.length === 0) {
            suggestionsContainer.innerHTML = '<p class="text-muted">Nessun suggerimento disponibile per questo veicolo.</p>';
            return;
        }

        let html = '<div class="suggestions-list">';
        const grouped = {};

        // Raggruppa per categoria
        suggestions.forEach(suggestion => {
            if (!grouped[suggestion.category]) {
                grouped[suggestion.category] = [];
            }
            grouped[suggestion.category].push(suggestion);
        });

        // Mostra raggruppati
        for (const [category, items] of Object.entries(grouped)) {
            const categoryInfo = items[0];
            html += `
                <div class="mb-3">
                    <h6 class="text-${categoryInfo.color}">
                        <i class="bi bi-${categoryInfo.icon}"></i> ${categoryInfo.category_name}
                    </h6>
                    <div class="ms-2">
            `;

            items.forEach(item => {
                html += `
                    <div class="suggestion-item" onclick="applySuggestion('${item.name.replace(/'/g, "\\'")}')">
                        <small>${item.name}</small>
                    </div>
                `;
            });

            html += `
                    </div>
                </div>
            `;
        }

        html += '</div>';
        suggestionsContainer.innerHTML = html;
    }

    // Aggiorna datalist
    function updateDatalist(suggestions) {
        setupSuggestions.innerHTML = suggestions.map(s =>
            `<option value="${s.name}">`
        ).join('');
    }

    // Applica suggerimento
    window.applySuggestion = function(name) {
        nameInput.value = name;
        nameInput.dispatchEvent(new Event('input'));

        // Trova e seleziona la categoria corrispondente
        const suggestion = currentSuggestions.find(s => s.name === name);
        if (suggestion) {
            categoryCards.forEach(card => {
                if (card.dataset.category === suggestion.category) {
                    card.click();
                }
            });
        }
    };

    // Controlla conflitti
    function checkConflicts() {
        const carId = carSelect.value;
        const name = nameInput.value;
        const dateFrom = dateFromInput.value;
        const dateTo = dateToInput.value;
        const excludeId = {{ $carSetup->id ?? 'null' }};

        if (!carId || !name || !dateFrom) {
            conflictAlert.classList.add('d-none');
            return;
        }

        const params = new URLSearchParams({
            car_id: carId,
            name: name,
            date_from: dateFrom,
            date_to: dateTo || '',
            exclude_id: excludeId || ''
        });

        fetch(`{{ route('car-setups.check-conflicts') }}?${params}`)
            .then(response => response.json())
            .then(data => {
                if (data.has_conflicts) {
                    conflictMessage.textContent = `Attenzione: Esiste già un allestimento "${name}" per questo veicolo nel periodo selezionato.`;
                    conflictAlert.classList.remove('d-none');
                } else {
                    conflictAlert.classList.add('d-none');
                }
            });
    }

    // Aggiorna preview
    function updatePreview() {
        const carOption = carSelect.options[carSelect.selectedIndex];
        const carName = carOption.text || 'N/D';
        const name = nameInput.value || 'N/D';
        const description = descriptionInput.value || '-';
        const dateFrom = dateFromInput.value ? new Date(dateFromInput.value).toLocaleDateString('it-IT') : 'N/D';
        const dateTo = dateToInput.value ? new Date(dateToInput.value).toLocaleDateString('it-IT') : 'Attivo';

        let categoryBadge = '';
        if (selectedCategory && currentSuggestions.length > 0) {
            const categoryInfo = currentSuggestions.find(s => s.category === selectedCategory);
            if (categoryInfo) {
                categoryBadge = `
                    <span class="badge bg-${categoryInfo.color}">
                        <i class="bi bi-${categoryInfo.icon}"></i> ${categoryInfo.category_name}
                    </span>
                `;
            }
        }

        previewContainer.innerHTML = `
            <div class="preview-content">
                <h6 class="mb-2">${name}</h6>
                ${categoryBadge}
                <hr>
                <dl class="row mb-0">
                    <dt class="col-sm-4">Veicolo:</dt>
                    <dd class="col-sm-8">${carName}</dd>

                    <dt class="col-sm-4">Periodo:</dt>
                    <dd class="col-sm-8">${dateFrom} - ${dateTo}</dd>

                    <dt class="col-sm-4">Descrizione:</dt>
                    <dd class="col-sm-8">${description}</dd>
                </dl>
            </div>
        `;
    }

    // Event listeners
    nameInput.addEventListener('input', function() {
        checkConflicts();
        updatePreview();
    });

    dateFromInput.addEventListener('change', function() {
        checkConflicts();
        updatePreview();

        // Imposta data minima per date_to
        dateToInput.min = this.value;
        if (dateToInput.value && dateToInput.value < this.value) {
            dateToInput.value = '';
        }
    });

    dateToInput.addEventListener('change', function() {
        checkConflicts();
        updatePreview();
    });

    descriptionInput.addEventListener('input', updatePreview);
    noteInput.addEventListener('input', updatePreview);

    // Se in modifica, carica suggerimenti iniziali
    @if($carSetup->car_id ?? false)
        carSelect.dispatchEvent(new Event('change'));
    @endif

    // Aggiorna preview iniziale
    updatePreview();
});
</script>
@endpush
