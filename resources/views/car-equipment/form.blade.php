@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- Selezione Veicolo --}}
        <div class="form-floating mb-3">
            <select name="car_id" id="car_id"
                    class="form-select @error('car_id') is-invalid @enderror">
                <option value="">-- Seleziona Veicolo --</option>
                @foreach($cars as $car)
                    @php
                        $plate = $car->carPlates->first();
                        $plateName = $plate ? " - {$plate->name}" : '';
                        $brandModel = '';
                        if($car->carBrand) {
                            $brandModel = " - {$car->carBrand->name}";
                            if($car->model) {
                                $brandModel .= " {$car->model}";
                            }
                        }
                        $carType = $car->carType ? " ({$car->carType->name})" : '';
                    @endphp
                    <option value="{{ $car->id }}"
                            {{ old('car_id', $carEquipment->car_id) == $car->id ? 'selected' : '' }}
                            data-type="{{ $car->carType->name ?? '' }}"
                            data-info="{{ $car->name . $plateName . $brandModel }}">
                        {{ $car->name }}{{ $plateName }}{{ $brandModel }}{{ $carType }}
                    </option>
                @endforeach
            </select>
            <label for="car_id" class="form-label">{{ __('Veicolo') }} <span class="text-danger">*</span></label>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Categorie Equipaggiamenti --}}
        <div class="mb-3" id="equipment-categories" style="display: none;">
            <label class="form-label">Categoria Equipaggiamento</label>
            <div class="btn-group-vertical w-100" role="group">
                <input type="radio" class="btn-check" name="equipment_category" id="cat_emergency" value="emergency">
                <label class="btn btn-outline-danger" for="cat_emergency">
                    <i class="bi bi-exclamation-triangle-fill"></i> Emergenza
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_communications" value="communications">
                <label class="btn btn-outline-primary" for="cat_communications">
                    <i class="bi bi-broadcast"></i> Comunicazioni
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_security" value="security">
                <label class="btn btn-outline-warning" for="cat_security">
                    <i class="bi bi-shield-fill"></i> Sicurezza
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_special" value="special">
                <label class="btn btn-outline-info" for="cat_special">
                    <i class="bi bi-tools"></i> Speciali
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_medical" value="medical">
                <label class="btn btn-outline-danger" for="cat_medical">
                    <i class="bi bi-heart-pulse-fill"></i> Medici
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_operational" value="operational">
                <label class="btn btn-outline-secondary" for="cat_operational">
                    <i class="bi bi-gear-fill"></i> Operativi
                </label>

                <input type="radio" class="btn-check" name="equipment_category" id="cat_custom" value="custom">
                <label class="btn btn-outline-success" for="cat_custom">
                    <i class="bi bi-palette-fill"></i> Personalizzazioni
                </label>
            </div>
        </div>

        {{-- Nome Equipaggiamento --}}
        <div class="form-floating mb-3">
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $carEquipment->name) }}"
                   placeholder="Nome Equipaggiamento"
                   list="equipment-suggestions">
            <label for="name" class="form-label">{{ __('Equipaggiamento') }} <span class="text-danger">*</span></label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

            {{-- Suggerimenti dinamici --}}
            <datalist id="equipment-suggestions">
                {{-- Popolato dinamicamente via JS --}}
            </datalist>
        </div>

        {{-- Descrizione --}}
        <div class="form-floating mb-3">
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $carEquipment->description) }}"
                   placeholder="Descrizione">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Date --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="date_from" id="date_from"
                           class="form-control @error('date_from') is-invalid @enderror"
                           value="{{ old('date_from', $carEquipment->date_from?->format('Y-m-d')) }}">
                    <label for="date_from" class="form-label">{{ __('Data Installazione') }} <span class="text-danger">*</span></label>
                    {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="date_to" id="date_to"
                           class="form-control @error('date_to') is-invalid @enderror"
                           value="{{ old('date_to', $carEquipment->date_to?->format('Y-m-d')) }}">
                    <label for="date_to" class="form-label">{{ __('Data Rimozione') }}</label>
                    {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    <small class="text-muted">Lasciare vuoto se ancora installato</small>
                </div>
            </div>
        </div>

        {{-- Note --}}
        <div class="form-floating mb-3">
            <textarea name="note" id="note"
                      class="form-control @error('note') is-invalid @enderror"
                      placeholder="Note"
                      style="height: 100px">{{ old('note', $carEquipment->note) }}</textarea>
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Preview Card --}}
        <div class="card mb-3" id="preview-card" style="display: none;">
            <div class="card-header bg-light">
                <h6 class="mb-0">Anteprima Equipaggiamento</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Veicolo:</strong> <span id="preview-car">-</span></p>
                        <p class="mb-1"><strong>Equipaggiamento:</strong> <span id="preview-name">-</span></p>
                        <p class="mb-1"><strong>Categoria:</strong> <span id="preview-category">-</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Periodo:</strong> <span id="preview-period">-</span></p>
                        <p class="mb-1"><strong>Stato:</strong> <span id="preview-status">-</span></p>
                        <p class="mb-1"><strong>Durata:</strong> <span id="preview-duration">-</span></p>
                    </div>
                </div>
                @if($carEquipment->exists)
                    <div class="alert alert-warning mt-2 mb-0">
                        <i class="bi bi-exclamation-triangle"></i> Stai modificando un equipaggiamento esistente
                    </div>
                @endif
            </div>
        </div>

    </div>
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva') }}
        </button>
        <a href="{{ route('car-equipments.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

@section('scripts')
<script>
// Equipaggiamenti disponibili per categoria
const equipmentsByCategory = @json(\App\Models\CarEquipment::getTypicalEquipments());

document.addEventListener('DOMContentLoaded', function() {
    const carSelect = document.getElementById('car_id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');
    const noteInput = document.getElementById('note');
    const previewCard = document.getElementById('preview-card');
    const equipmentCategories = document.getElementById('equipment-categories');
    const datalist = document.getElementById('equipment-suggestions');

    // Gestione categorie
    document.querySelectorAll('input[name="equipment_category"]').forEach(radio => {
        radio.addEventListener('change', function() {
            updateEquipmentSuggestions(this.value);
        });
    });

    // Aggiorna suggerimenti in base alla categoria
    function updateEquipmentSuggestions(category) {
        datalist.innerHTML = '';
        if (equipmentsByCategory[category]) {
            equipmentsByCategory[category].forEach(equipment => {
                const option = document.createElement('option');
                option.value = equipment;
                datalist.appendChild(option);
            });
        }
    }

    // Mostra categorie quando si seleziona un veicolo
    carSelect.addEventListener('change', function() {
        if (this.value) {
            equipmentCategories.style.display = 'block';

            // Suggerimenti intelligenti basati sul tipo di veicolo
            const selectedOption = this.options[this.selectedIndex];
            const carType = selectedOption.getAttribute('data-type');

            // Pre-seleziona categoria in base al tipo veicolo
            if (carType) {
                if (carType.toLowerCase().includes('ambulanza')) {
                    document.getElementById('cat_medical').checked = true;
                    updateEquipmentSuggestions('medical');
                } else if (carType.toLowerCase().includes('polizia') ||
                          carType.toLowerCase().includes('carabinieri')) {
                    document.getElementById('cat_emergency').checked = true;
                    updateEquipmentSuggestions('emergency');
                }
            }
        } else {
            equipmentCategories.style.display = 'none';
        }
        updatePreview();
    });

    // Funzione per calcolare la durata
    function calculateDuration() {
        if (!dateFromInput.value) return '-';

        const startDate = new Date(dateFromInput.value);
        const endDate = dateToInput.value ? new Date(dateToInput.value) : new Date();
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays > 365) {
            return Math.round(diffDays / 365 * 10) / 10 + ' anni';
        } else if (diffDays > 30) {
            return Math.round(diffDays / 30 * 10) / 10 + ' mesi';
        } else {
            return diffDays + ' giorni';
        }
    }

    // Funzione per aggiornare la preview
    function updatePreview() {
        const carOption = carSelect.options[carSelect.selectedIndex];

        if (carSelect.value || nameInput.value) {
            previewCard.style.display = 'block';

            // Aggiorna i valori della preview
            document.getElementById('preview-car').textContent = carOption && carSelect.value ?
                carOption.getAttribute('data-info') : '-';
            document.getElementById('preview-name').textContent = nameInput.value || '-';

            // Categoria
            const selectedCategory = document.querySelector('input[name="equipment_category"]:checked');
            if (selectedCategory) {
                const categoryLabels = {
                    'emergency': 'Emergenza',
                    'communications': 'Comunicazioni',
                    'security': 'Sicurezza',
                    'special': 'Speciali',
                    'medical': 'Medici',
                    'operational': 'Operativi',
                    'custom': 'Personalizzazioni'
                };
                document.getElementById('preview-category').textContent = categoryLabels[selectedCategory.value] || '-';
            } else {
                document.getElementById('preview-category').textContent = '-';
            }

            // Periodo
            let period = '-';
            if (dateFromInput.value) {
                const fromDate = new Date(dateFromInput.value).toLocaleDateString('it-IT');
                period = 'Dal ' + fromDate;
                if (dateToInput.value) {
                    const toDate = new Date(dateToInput.value).toLocaleDateString('it-IT');
                    period += ' al ' + toDate;
                } else {
                    period += ' (in corso)';
                }
            }
            document.getElementById('preview-period').textContent = period;

            // Stato
            let status = '-';
            if (dateFromInput.value) {
                const now = new Date();
                const startDate = new Date(dateFromInput.value);

                if (startDate > now) {
                    status = 'Da installare';
                } else if (!dateToInput.value || new Date(dateToInput.value) >= now) {
                    status = 'Installato';
                } else {
                    status = 'Rimosso';
                }
            }
            document.getElementById('preview-status').innerHTML =
                status === 'Installato' ? '<span class="badge bg-success">Installato</span>' :
                status === 'Rimosso' ? '<span class="badge bg-secondary">Rimosso</span>' :
                '<span class="badge bg-warning">Da installare</span>';

            // Durata
            document.getElementById('preview-duration').textContent = calculateDuration();
        } else {
            previewCard.style.display = 'none';
        }
    }

    // Aggiungi listener per aggiornare la preview
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    dateFromInput.addEventListener('change', updatePreview);
    dateToInput.addEventListener('change', updatePreview);
    noteInput.addEventListener('input', updatePreview);

    // Validazione date
    dateFromInput.addEventListener('change', function() {
        if (dateToInput.value && this.value > dateToInput.value) {
            dateToInput.value = this.value;
        }
    });

    dateToInput.addEventListener('change', function() {
        if (dateFromInput.value && this.value < dateFromInput.value) {
            this.value = dateFromInput.value;
        }
    });

    // Inizializza la preview se ci sono valori esistenti
    updatePreview();

    // Se stiamo modificando, mostra le categorie
    if (carSelect.value) {
        equipmentCategories.style.display = 'block';
    }
});
</script>
@endsection
