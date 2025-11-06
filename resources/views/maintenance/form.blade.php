@php($button = $button ?? true)
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Veicolo -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">

                            <x-dynamic-select
                                    name="office_id"
                                    :required="'true'"
                                    :value="old('car_id', $maintenance?->car_id)"
                                    :options="$cars"
                                    :errors="$errors"
                                    endpoint="{{ route('car.storeForm') }}"
                                    label="{{ __('Veicolo') }}"
                                    labelKey="full_name"
                                    idKey="id"
                                    modal-url="{{ route('car.getForm') }}"
                                    modal-title="Nuova Vettura"
                            />

{{--                            <select name="car_id" id="car_id" class="form-select @error('car_id') is-invalid @enderror"--}}
{{--                                    required>--}}
{{--                                <option value="">Seleziona un veicolo...</option>--}}
{{--                                @foreach($cars as $car)--}}
{{--                                    <option value="{{ $car->id }}"--}}
{{--                                            {{ old('car_id', $maintenance->car_id ?? '') == $car->id ? 'selected' : '' }}--}}
{{--                                            data-km="{{ $car->km ?? 0 }}">--}}
{{--                                        {{ $car->name }}--}}
{{--                                        @if($car->carPlates->count() > 0)--}}
{{--                                            - {{ $car->carPlates->first()->name }}--}}
{{--                                        @endif--}}
{{--                                        @if($car->carBrand)--}}
{{--                                            ({{ $car->carBrand->name }})--}}
{{--                                        @endif--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <label for="car_id">{{ __('Veicolo') }} <span class="text-danger">*</span></label>--}}
{{--                            @error('car_id')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Tipo Manutenzione -->
                    <div class="col-md-12 mb-3">

                        <x-dynamic-select
                                name="garage_id"
                                :required="'true'"
                                :value="old('garage_id', $maintenance?->garage_id)"
                                :options="$garages"
                                :errors="$errors"
                                endpoint="{{ route('car.storeForm') }}"
                                label="{{ __('Veicolo') }}"
                                labelKey="full_name"
                                idKey="id"
                                modal-url="{{ route('car.getForm') }}"
                                modal-title="Nuova Vettura"
                        />



                        {{--                        <div class="form-floating">--}}
{{--                            <input type="text" name="name" id="name"--}}
{{--                                   class="form-control @error('name') is-invalid @enderror"--}}
{{--                                   value="{{ old('name', $maintenance->name ?? '') }}"--}}
{{--                                   placeholder="Es: Tagliando Ordinario"--}}
{{--                                   required>--}}
{{--                            <label for="name">{{ __('Tipo Manutenzione') }} <span class="text-danger">*</span></label>--}}
{{--                            @error('name')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div id="name-suggestions" class="mt-2"></div>--}}
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $maintenance->description ?? '') }}"
                                   placeholder="Es: Cambio olio, filtri e controllo generale">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="description-suggestions" class="mt-2"></div>
                    </div>
                </div>

                <div class="row">
                    <!-- Data Inizio -->
                    <div class="col-md-6 mb-3">
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

                <div class="row">
                    <!-- Note -->
                    <div class="col-md-12 mb-3">
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
                    <li>Registra tutte le manutenzioni per tenere traccia dello storico</li>
                    <li>Specifica sempre il tipo di intervento</li>
                    <li>Aggiungi le officine dopo aver salvato la manutenzione</li>
                    <li>Controlla eventuali sovrapposizioni con altre manutenzioni</li>
                    <li>Usa le note per dettagli importanti</li>
                </ul>
            </div>
        </div>

        <!-- Alert Sovrapposizioni -->
        <div id="overlap-alert" class="alert alert-warning mt-3" style="display: none;">
            <i class="bi bi-exclamation-triangle"></i>
            <strong>Attenzione!</strong>
            <span id="overlap-message"></span>
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Carica suggerimenti quando cambia il veicolo
            $('#car_id').change(function () {
                var carId = $(this).val();
                if (carId) {
                    loadSuggestions(carId);
                }
                updatePreview();
            });

            // Carica suggerimenti
            function loadSuggestions(carId) {
                // Suggerimenti per nome
                $.get('/maintenances/suggestions', {car_id: carId, type: 'name'})
                    .done(function (suggestions) {
                        if (suggestions.length > 0) {
                            var html = '<small class="text-muted">Suggerimenti: ';
                            suggestions.forEach(function (suggestion, index) {
                                if (index > 0) html += ' | ';
                                html += '<a href="#" class="suggestion-link-name text-decoration-none">' + suggestion + '</a>';
                            });
                            html += '</small>';
                            $('#name-suggestions').html(html);
                        }
                    });

                // Suggerimenti per descrizione
                $.get('/maintenances/suggestions', {car_id: carId, type: 'description'})
                    .done(function (suggestions) {
                        if (suggestions.length > 0) {
                            var html = '<small class="text-muted">Suggerimenti: ';
                            suggestions.forEach(function (suggestion, index) {
                                if (index > 0) html += ' | ';
                                html += '<a href="#" class="suggestion-link-desc text-decoration-none">' + suggestion + '</a>';
                            });
                            html += '</small>';
                            $('#description-suggestions').html(html);
                        }
                    });
            }

            // Click sui suggerimenti nome
            $(document).on('click', '.suggestion-link-name', function (e) {
                e.preventDefault();
                $('#name').val($(this).text());
                updatePreview();
            });

            // Click sui suggerimenti descrizione
            $(document).on('click', '.suggestion-link-desc', function (e) {
                e.preventDefault();
                $('#description').val($(this).text());
                updatePreview();
            });

            // Validazione date
            $('#date_from').change(function () {
                var dateFrom = $(this).val();
                $('#date_to').attr('min', dateFrom);
                updatePreview();
            });

            $('#date_to').change(function () {
                updatePreview();
            });

            // Aggiorna anteprima
            function updatePreview() {
                var car = $('#car_id option:selected').text();
                var name = $('#name').val();
                var description = $('#description').val();
                var dateFrom = $('#date_from').val();
                var dateTo = $('#date_to').val();

                if (car && name && dateFrom) {
                    var dateFromFormatted = new Date(dateFrom).toLocaleDateString('it-IT');
                    var html = '<div class="border rounded p-3">';
                    html += '<h6 class="mb-2"><i class="bi bi-wrench"></i> ' + name + '</h6>';
                    html += '<p class="mb-1"><strong>Veicolo:</strong> ' + car + '</p>';
                    html += '<p class="mb-1"><strong>Inizio:</strong> ' + dateFromFormatted;

                    if (dateTo) {
                        var dateToFormatted = new Date(dateTo).toLocaleDateString('it-IT');
                        html += ' - <strong>Fine:</strong> ' + dateToFormatted;

                        // Calcola durata
                        var start = new Date(dateFrom);
                        var end = new Date(dateTo);
                        var days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                        html += '<br><small class="text-muted">Durata: ' + days + ' ' + (days == 1 ? 'giorno' : 'giorni') + '</small>';
                    } else {
                        html += '<br><small class="text-muted">Manutenzione in corso</small>';
                    }

                    if (description) {
                        html += '<p class="mb-0"><strong>Descrizione:</strong> ' + description + '</p>';
                    }
                    html += '</div>';

                    $('#preview-content').html(html);
                } else {
                    $('#preview-content').html('<p class="text-muted text-center"><i class="bi bi-arrow-left"></i> Compila i campi per vedere l\'anteprima</p>');
                }
            }

            // Aggiorna anteprima in tempo reale
            $('#name, #description').on('input', updatePreview);

            // Trigger iniziale
            $('#car_id').trigger('change');
        });
    </script>
@endpush
