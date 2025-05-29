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
        
        <div class="form-group mb-2 mb20">
            <label for="car_id" class="form-label">{{ __('Veicolo') }} <span class="text-danger">*</span></label>
            <select name="car_id" class="form-control @error('car_id') is-invalid @enderror" id="car_id">
                <option value="">Seleziona veicolo</option>
                @foreach($cars as $id => $carName)
                    <option value="{{ $id }}" {{ old('car_id', $carPlate?->car_id) == $id ? 'selected' : '' }}>
                        {{ $carName }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Seleziona il veicolo a cui assegnare questa targa</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Numero Targa') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carPlate?->name) }}" id="name" placeholder="Es: AB 123 CD" maxlength="20" style="font-family: monospace; font-weight: bold;">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il numero di targa (solo lettere maiuscole e numeri)</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="type" class="form-label">{{ __('Tipo Targa') }} <span class="text-danger">*</span></label>
            <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                <option value="">Seleziona tipo</option>
                <option value="CIV" {{ old('type', $carPlate?->type) == 'CIV' ? 'selected' : '' }}>
                    CIV - Civile (Standard)
                </option>
                <option value="POL" {{ old('type', $carPlate?->type) == 'POL' ? 'selected' : '' }}>
                    POL - Polizia (Forze dell'Ordine)
                </option>
                <option value="ALTRO" {{ old('type', $carPlate?->type) == 'ALTRO' ? 'selected' : '' }}>
                    ALTRO - Altro tipo
                </option>
            </select>
            {!! $errors->first('type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Tipo di targa secondo la classificazione italiana</small>
        </div>

    </div>
    
    <div class="col-md-6">
        
        <div class="form-group mb-2 mb20">
            <label for="date_from" class="form-label">{{ __('Data Inizio') }} <span class="text-danger">*</span></label>
            <input type="date" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from', $carPlate?->date_from) }}" id="date_from">
            {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Data di assegnazione della targa al veicolo</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="date_to" class="form-label">{{ __('Data Fine') }}</label>
            <input type="date" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to', $carPlate?->date_to) }}" id="date_to">
            {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Data di scadenza o rimozione (lasciare vuoto se attiva)</small>
        </div>
        
        <!-- Suggerimenti per formati targa -->
        <div class="form-group mb-2">
            <label class="form-label">Formati Targa Comuni:</label>
            <div class="row">
                <div class="col-12">
                    <div class="btn-group-vertical w-100" role="group">
                        <button type="button" class="btn btn-outline-secondary btn-sm plate-suggestion" data-format="AA 123 BB" data-description="Formato standard italiano (2 lettere + 3 numeri + 2 lettere)">
                            <span class="plate-mini plate-civil">AA 123 BB</span> Standard Italiano
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm plate-suggestion" data-format="POLIZIA 123" data-description="Formato Polizia di Stato">
                            <span class="plate-mini plate-police">POLIZIA 123</span> Polizia di Stato
                        </button>
                        <button type="button" class="btn btn-outline-info btn-sm plate-suggestion" data-format="CC 123 AA" data-description="Formato Carabinieri">
                            <span class="plate-mini plate-police">CC 123 AA</span> Carabinieri
                        </button>
                        <button type="button" class="btn btn-outline-warning btn-sm plate-suggestion" data-format="123456" data-description="Formato numerico">
                            <span class="plate-mini plate-other">123456</span> Solo numeri
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="3" placeholder="Note aggiuntive sulla targa">{{ old('note', $carPlate?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni aggiuntive, motivi di cambio targa, ecc.</small>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('car-plates.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const typeSelect = document.getElementById('type');
    const previewPlate = document.getElementById('preview-plate');
    const previewText = document.getElementById('preview-text');
    const previewDescription = document.getElementById('preview-description');
    
    // Gestisci i suggerimenti di formato
    document.querySelectorAll('.plate-suggestion').forEach(button => {
        button.addEventListener('click', function() {
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
        const type = typeSelect.value || 'CIV';
        
        previewText.textContent = name;
        
        // Aggiorna stile in base al tipo
        previewPlate.className = 'plate';
        let description = '';
        
        switch(type) {
            case 'POL':
                previewPlate.classList.add('plate-police');
                description = 'Targa Polizia/Forze dell\'Ordine';
                break;
            case 'CIV':
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
    nameInput.addEventListener('input', function() {
        // Converte automaticamente in maiuscolo
        this.value = this.value.toUpperCase();
        updatePreview();
    });
    
    typeSelect.addEventListener('change', updatePreview);
    
    // Inizializza anteprima
    updatePreview();
    
    // Validazione formato targa in tempo reale
    nameInput.addEventListener('input', function() {
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