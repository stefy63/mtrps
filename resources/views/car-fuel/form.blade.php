@php($button = $button ?? true)
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Rifornimento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Veicolo -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="car_id" id="car_id" class="form-select @error('car_id') is-invalid @enderror" required>
                                <option value="">Seleziona un veicolo...</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ old('car_id', $carFuel->car_id ?? '') == $car->id ? 'selected' : '' }}
                                        data-power="{{ $car->carPower ? $car->carPower->name : '' }}">
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
                        <div id="car-info" class="mt-2 small text-muted" style="display: none;">
                            <i class="bi bi-info-circle"></i> <span id="car-power-info"></span>
                        </div>
                    </div>

                    <!-- Utente -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">Utente corrente</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $carFuel->user_id ?? Auth::id()) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user_id">{{ __('Utente che effettua il rifornimento') }}</label>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Data Rifornimento -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="date_from" id="date_from"
                                class="form-control @error('date_from') is-invalid @enderror"
                                value="{{ old('date_from', $carFuel->date_from ? $carFuel->date_from->format('Y-m-d') : date('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}"
                                required>
                            <label for="date_from">{{ __('Data Rifornimento') }} <span class="text-danger">*</span></label>
                            @error('date_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Data Fine (opzionale) -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="date_to" id="date_to"
                                class="form-control @error('date_to') is-invalid @enderror"
                                value="{{ old('date_to', $carFuel->date_to ? $carFuel->date_to->format('Y-m-d') : '') }}">
                            <label for="date_to">{{ __('Data Fine (opzionale)') }}</label>
                            @error('date_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Utilizzare solo per rifornimenti multipli o periodi</small>
                    </div>
                </div>

                <div class="row">
                    <!-- Tipo Rifornimento -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $carFuel->name ?? '') }}"
                                placeholder="Es: Rifornimento Benzina Verde"
                                required>
                            <label for="name">{{ __('Tipo Rifornimento') }} <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="name-suggestions" class="mt-2"></div>
                    </div>

                    <!-- Dettagli -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $carFuel->description ?? '') }}"
                                placeholder="Es: 40 litri presso ENI via Roma">
                            <label for="description">{{ __('Dettagli (opzionale)') }}</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Puoi inserire quantità, stazione di servizio, importo, etc.</small>
                    </div>

                    <!-- Note -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                class="form-control @error('note') is-invalid @enderror"
                                style="height: 100px"
                                placeholder="Note aggiuntive...">{{ old('note', $carFuel->note ?? '') }}</textarea>
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
                    <li>Registra ogni rifornimento per monitorare i consumi</li>
                    <li>Specifica il tipo di carburante nel nome</li>
                    <li>Aggiungi dettagli come quantità e importo</li>
                    <li>Usa le note per informazioni aggiuntive</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Rifornimento') }}
        </button>
        <a href="{{ route('car-fuels.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Gestione cambio veicolo
    $('#car_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var powerType = selectedOption.data('power');

        if (powerType) {
            $('#car-info').show();
            $('#car-power-info').text('Alimentazione: ' + powerType);

            // Carica suggerimenti basati sul tipo di alimentazione
            loadFuelSuggestions($(this).val());
        } else {
            $('#car-info').hide();
        }

        updatePreview();
    });

    // Carica suggerimenti rifornimento
    function loadFuelSuggestions(carId) {
        if (!carId) return;

        $.get('/car-fuels/suggestions', { car_id: carId, type: 'name' })
            .done(function(suggestions) {
                if (suggestions.length > 0) {
                    var html = '<small class="text-muted">Suggerimenti: ';
                    suggestions.forEach(function(suggestion, index) {
                        if (index > 0) html += ' | ';
                        html += '<a href="#" class="suggestion-link text-decoration-none">' + suggestion + '</a>';
                    });
                    html += '</small>';
                    $('#name-suggestions').html(html);
                } else {
                    $('#name-suggestions').empty();
                }
            });
    }

    // Click sui suggerimenti
    $(document).on('click', '.suggestion-link', function(e) {
        e.preventDefault();
        $('#name').val($(this).text());
        updatePreview();
    });

    // Validazione date
    $('#date_from').change(function() {
        var dateFrom = $(this).val();
        $('#date_to').attr('min', dateFrom);
        updatePreview();
    });

    // Aggiorna anteprima
    function updatePreview() {
        var car = $('#car_id option:selected').text();
        var date = $('#date_from').val();
        var name = $('#name').val();
        var description = $('#description').val();
        var user = $('#user_id option:selected').text() || 'Utente corrente';

        if (car && date && name) {
            var dateFormatted = new Date(date).toLocaleDateString('it-IT');
            var html = '<div class="border rounded p-3">';
            html += '<h6 class="mb-2"><i class="bi bi-fuel-pump"></i> ' + name + '</h6>';
            html += '<p class="mb-1"><strong>Veicolo:</strong> ' + car + '</p>';
            html += '<p class="mb-1"><strong>Data:</strong> ' + dateFormatted + '</p>';
            if (description) {
                html += '<p class="mb-1"><strong>Dettagli:</strong> ' + description + '</p>';
            }
            html += '<p class="mb-0"><small class="text-muted">Registrato da: ' + user + '</small></p>';
            html += '</div>';

            $('#preview-content').html(html);
        } else {
            $('#preview-content').html('<p class="text-muted text-center"><i class="bi bi-arrow-left"></i> Compila i campi per vedere l\'anteprima</p>');
        }
    }

    // Aggiorna anteprima in tempo reale
    $('#name, #description').on('input', updatePreview);
    $('#user_id, #date_from').change(updatePreview);

    // Trigger iniziale
    $('#car_id').trigger('change');
});
</script>
@endpush
