@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <!-- Anteprima Targa -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Anteprima Targa</h6>
            </div>
            <div class="card-body text-center">
                <div id="plate-preview" class="d-inline-block">
                    <div id="preview-plate" class="plate plate-civil">
                        <span id="preview-text">AA 123 BB</span>
                    </div>
                </div>
                <div class="mt-2">
                    <small id="preview-description" class="text-muted">Targa Civile Italiana</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group mb-2 ">
            <label for="name" class="form-label">{{ __('Numero Targa') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="text-uppercase form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $carPlate?->name) }}" id="name" placeholder="Es: AB 123 CD" maxlength="20"
                   style="font-family: monospace; font-weight: bold;">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il numero di targa (solo lettere maiuscole e numeri)</small>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group mb-2 ">
            <label for="type" class="form-label">{{ __('Tipo Targa') }} <span class="text-danger">*</span></label>
            <select name="type" class="form-control @error('type') is-invalid @enderror" id="type" @if(!$button) disabled @endif>
                <option value="">Seleziona tipo</option>
                <option value="CIVILE" {{ old('type', $carPlate?->type) == 'CIVILE' ? 'selected' : '' }}>
                    CIVILE - Civile (Standard)
                </option>
                <option value="POLIZIA" {{ old('type', $carPlate?->type) == 'POLIZIA' ? 'selected' : '' }}>
                    POLIZIA - Polizia (Forze dell'Ordine)
                </option>
                <option value="ORIGINALE" {{ old('type', $carPlate?->type) == 'ORIGINALE' ? 'selected' : '' }}>
                    ORIGINALE - Altro tipo
                </option>
            </select>
            {!! $errors->first('type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Tipo di targa secondo la classificazione italiana</small>
            @if(!$button)
                <input type="hidden"  name="type" value="{{$carPlate?->type}}" >
            @endif
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group mb-2 ">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="3"
                      placeholder="Note aggiuntive sulla targa">{{ old('note', $carPlate?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni aggiuntive, motivi di cambio targa, ecc.</small>
        </div>
    </div>
    @if($button)
        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            <a href="{{ route('car-plates.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>
    @endif
</div>

<style>
    .plate {
        display: inline-block;
        padding: 8px 16px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 18px;
        border: 3px solid;
        border-radius: 6px;
        text-align: center;
        min-width: 140px;
        letter-spacing: 2px;
    }

    .plate-mini {
        display: inline-block;
        padding: 2px 6px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 11px;
        border: 1px solid;
        border-radius: 3px;
        text-align: center;
        min-width: 70px;
        letter-spacing: 1px;
    }

    .plate-civil, .plate-mini.plate-civil {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }

    .plate-police, .plate-mini.plate-police {
        background-color: #1e3a8a;
        color: #ffffff;
        border-color: #ffffff;
    }

    .plate-other, .plate-mini.plate-other {
        background-color: #f3f4f6;
        color: #374151;
        border-color: #6b7280;
    }

    .plate-suggestion {
        text-align: left;
        margin-bottom: 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const typeSelect = document.getElementById('type');
        const previewPlate = document.getElementById('preview-plate');
        const previewText = document.getElementById('preview-text');
        const previewDescription = document.getElementById('preview-description');

        // Gestisci i suggerimenti di formato
        document.querySelectorAll('.plate-suggestion').forEach(button => {
            button.addEventListener('click', function () {
                const format = this.dataset.format;
                const description = this.dataset.description;

                nameInput.value = format;
                updatePreview();

                // Evidenzia temporaneamente
                this.classList.add('active');
                setTimeout(() => {
                    this.classList.remove('active');
                }, 500);
            });
        });

        // Aggiorna anteprima in tempo reale
        function updatePreview() {
            const name = nameInput.value || 'AA 123 BB';
            const type = typeSelect.value || 'CIVILE';

            previewText.textContent = name;

            // Aggiorna stile in base al tipo
            previewPlate.className = 'plate';
            let description = '';

            switch (type) {
                case 'POLIZIA':
                    previewPlate.classList.add('plate-police');
                    description = 'Targa Polizia/Forze dell\'Ordine';
                    break;
                case 'CIVILE':
                    previewPlate.classList.add('plate-civil');
                    description = 'Targa Civile Standard';
                    break;
                default:
                    previewPlate.classList.add('plate-other');
                    description = 'Altro tipo di targa';
            }

            previewDescription.textContent = description;
        }

        // Ascolta i cambiamenti
        nameInput.addEventListener('input', function () {
            // Converte automaticamente in maiuscolo
            this.value = this.value.toUpperCase();
            updatePreview();
        });

        typeSelect.addEventListener('change', updatePreview);

        // Inizializza anteprima
        updatePreview();

        // Validazione formato targa in tempo reale
        nameInput.addEventListener('input', function () {
            const value = this.value;
            const isValid = /^[A-Z0-9\s]*$/.test(value);

            if (!isValid && value) {
                this.classList.add('is-invalid');
                if (!document.getElementById('format-error')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'format-error';
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'Usa solo lettere maiuscole, numeri e spazi';
                    this.parentNode.appendChild(errorDiv);
                }
            } else {
                this.classList.remove('is-invalid');
                const errorDiv = document.getElementById('format-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
    });
</script>