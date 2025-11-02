@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- Selezione Assegnatario --}}
        <div class="form-floating mb-3">
            <select name="car_assignee_id" id="car_assignee_id"
                    class="form-select @error('car_assignee_id') is-invalid @enderror">
                <option value="">-- Seleziona Assegnatario --</option>
                @foreach($carAssignees as $assignee)
                    @php
                        $car = $assignee->car;
                        $plate = $car ? $car->carPlates->first() : null;
                        $plateName = $plate ? " ({$plate->name})" : '';
                        $carInfo = $car ? " - {$car->name}{$plateName}" : '';
                        $dateInfo = $assignee->date_from ? " - Dal " . $assignee->date_from : '';
                        if($assignee->date_to) {
                            $dateInfo .= " al " . $assignee->date_to;
                        }
                    @endphp
                    <option value="{{ $assignee->id }}"
                            {{ old('car_assignee_id', $assigneeOffice->car_assignee_id) == $assignee->id ? 'selected' : '' }}
                            data-info="{{ $assignee->description }}"
                            {{ (!$assignee->is_active) ? 'class=text-muted' : '' }}>
                        {{ $assignee->name }}{{ $carInfo }}{{ $dateInfo }}
                        {{ (!$assignee->is_active) ? ' (INATTIVO)' : '' }}
                    </option>
                @endforeach
            </select>
            <label for="car_assignee_id" class="form-label">{{ __('Assegnatario') }} <span class="text-danger">*</span></label>
            {!! $errors->first('car_assignee_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="text-muted">Seleziona l'assegnatario a cui appartiene l'ufficio</small>
        </div>

        {{-- Nome Ufficio --}}
        <div class="form-floating mb-3">
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $assigneeOffice->name) }}"
                   placeholder="Nome Ufficio"
                   list="office-suggestions">
            <label for="name" class="form-label">{{ __('Nome Ufficio') }} <span class="text-danger">*</span></label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

            {{-- Suggerimenti Uffici --}}
            <datalist id="office-suggestions">
                @foreach(\App\Models\AssigneeOffice::getTypicalOffices() as $office)
                    <option value="{{ $office }}">
                @endforeach
            </datalist>
        </div>

        {{-- Descrizione --}}
        <div class="form-floating mb-3">
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $assigneeOffice->description) }}"
                   placeholder="Descrizione">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Note --}}
        <div class="form-floating mb-3">
            <textarea name="note" id="note"
                      class="form-control @error('note') is-invalid @enderror"
                      placeholder="Note"
                      style="height: 100px">{{ old('note', $assigneeOffice->note) }}</textarea>
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Preview Card --}}
        <div class="card mb-3" id="preview-card" style="display: none;">
            <div class="card-header bg-light">
                <h6 class="mb-0">Anteprima Ufficio</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Ufficio:</strong> <span id="preview-name">-</span></p>
                        <p class="mb-1"><strong>Assegnatario:</strong> <span id="preview-assignee">-</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Descrizione:</strong> <span id="preview-description">-</span></p>
                        <p class="mb-1"><strong>Note:</strong> <span id="preview-note">-</span></p>
                    </div>
                </div>
                <div id="assignee-details" class="mt-2 p-2 bg-light rounded" style="display: none;">
                    <small class="text-muted">Info assegnatario: <span id="assignee-info"></span></small>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva') }}
        </button>
        <a href="{{ route('assignee-offices.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const assigneeSelect = document.getElementById('car_assignee_id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const noteInput = document.getElementById('note');
    const previewCard = document.getElementById('preview-card');

    // Funzione per aggiornare la preview
    function updatePreview() {
        const assigneeOption = assigneeSelect.options[assigneeSelect.selectedIndex];

        if (assigneeSelect.value || nameInput.value || descriptionInput.value) {
            previewCard.style.display = 'block';

            // Aggiorna i valori della preview
            document.getElementById('preview-name').textContent = nameInput.value || '-';
            document.getElementById('preview-assignee').textContent = assigneeOption && assigneeSelect.value ?
                assigneeOption.text.replace(' (INATTIVO)', '') : '-';
            document.getElementById('preview-description').textContent = descriptionInput.value || '-';
            document.getElementById('preview-note').textContent = noteInput.value || '-';

            // Mostra info assegnatario se disponibili
            const assigneeInfo = assigneeOption ? assigneeOption.getAttribute('data-info') : null;
            const assigneeDetails = document.getElementById('assignee-details');
            const assigneeInfoSpan = document.getElementById('assignee-info');

            if (assigneeInfo && assigneeInfo !== 'null') {
                assigneeDetails.style.display = 'block';
                assigneeInfoSpan.textContent = assigneeInfo;
            } else {
                assigneeDetails.style.display = 'none';
            }
        } else {
            previewCard.style.display = 'none';
        }
    }

    // Aggiungi listener per aggiornare la preview
    assigneeSelect.addEventListener('change', updatePreview);
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    noteInput.addEventListener('input', updatePreview);

    // Suggerimenti intelligenti basati sull'assegnatario
    assigneeSelect.addEventListener('change', function() {
        const selectedText = this.options[this.selectedIndex].text.toLowerCase();

        // Se l'ufficio è vuoto, suggerisci in base al tipo di assegnatario
        if (!nameInput.value) {
            if (selectedText.includes('comando') || selectedText.includes('questura')) {
                // Suggerimenti per forze dell'ordine
                const suggestions = ['Ufficio del Comandante', 'Nucleo Operativo', 'Squadra Mobile', 'Ufficio Denunce'];
                nameInput.setAttribute('placeholder', suggestions[0]);
            } else if (selectedText.includes('sindaco') || selectedText.includes('assessor')) {
                // Suggerimenti per amministrazioni comunali
                const suggestions = ['Segreteria del Sindaco', 'Ufficio di Gabinetto', 'Ufficio Stampa'];
                nameInput.setAttribute('placeholder', suggestions[0]);
            } else if (selectedText.includes('ministero')) {
                // Suggerimenti per ministeri
                const suggestions = ['Segreteria Generale', 'Ufficio di Gabinetto', 'Direzione Generale'];
                nameInput.setAttribute('placeholder', suggestions[0]);
            }
        }
    });

    // Inizializza la preview se ci sono valori esistenti
    updatePreview();
});
</script>
@endsection
