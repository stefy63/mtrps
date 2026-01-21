@php($button = $button ?? true)
<div class="row padding-1 p-1">
    
    <!-- Anteprima Assegnazione -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Anteprima Assegnazione</h6>
            </div>
            <div class="card-body">
                <div id="assignment-preview" class="d-flex align-items-center">
                    <div id="preview-icon" class="assignee-icon d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-user text-secondary fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 id="preview-name" class="mb-1 text-primary">Nome Assegnatario</h5>
                        <p id="preview-description" class="mb-1 text-muted">Descrizione assegnatario</p>
                        <div class="d-flex align-items-center">
                            <span id="preview-vehicle" class="badge badge-outline-primary me-2">Seleziona veicolo</span>
                            <span id="preview-period" class="badge badge-outline-info">Periodo assegnazione</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        
        <div class="form-group mb-2 ">
            <label for="car_id" class="form-label">{{ __('Veicolo') }} <span class="text-danger">*</span></label>
            <select name="car_id" class="form-control @error('car_id') is-invalid @enderror" id="car_id">
                <option value="">Seleziona veicolo</option>
                @foreach($cars as $id => $carName)
                    <option value="{{ $id }}" {{ old('car_id', $carAssignee?->car_id) == $id ? 'selected' : '' }}>
                        {{ $carName }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Seleziona il veicolo da assegnare</small>
        </div>
        
        <div class="form-group mb-2 ">
            <label for="name" class="form-label">{{ __('Nome Assegnatario') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carAssignee?->name) }}" id="name" placeholder="Nome e cognome dell'assegnatario">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il nome completo della persona o ufficio assegnatario</small>
        </div>
        
        <div class="form-group mb-2 ">
            <label for="description" class="form-label">{{ __('Descrizione/Ruolo') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $carAssignee?->description) }}" id="description" placeholder="Ruolo, qualifica o descrizione">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Es. Dirigente, Ispettore, Ufficio Tecnico, ecc.</small>
        </div>

    </div>
    
    <div class="col-md-6">
        
        <div class="form-group mb-2 ">
            <label for="date_from" class="form-label">{{ __('Data Inizio Assegnazione') }} <span class="text-danger">*</span></label>
            <input type="date" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from', $carAssignee?->date_from) }}" id="date_from">
            {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Data di inizio dell'assegnazione del veicolo</small>
        </div>
        
        <div class="form-group mb-2 ">
            <label for="date_to" class="form-label">{{ __('Data Fine Assegnazione') }}</label>
            <input type="date" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to', $carAssignee?->date_to) }}" id="date_to">
            {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Data di fine (lasciare vuoto se assegnazione a tempo indeterminato)</small>
        </div>
        
        <div class="form-group mb-2 ">
            <label class="form-label">Controllo Sovrapposizioni</label>
            <div id="overlap-check" class="alert alert-info" style="display: none;">
                <i class="fas fa-info-circle"></i> <span id="overlap-message"></span>
            </div>
            <div id="overlap-warning" class="alert alert-warning" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i> <span id="overlap-warning-message"></span>
            </div>
        </div>

    </div>
    
    <div class="col-md-12">
        
        <!-- Suggerimenti per tipi di assegnatari -->
        <div class="form-group mb-3">
            <label class="form-label">Suggerimenti per categoria:</label>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary bg-opacity-10">
                            <small><strong><i class="fas fa-user-tie"></i> Dirigenti</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="assignee-suggestion" data-name="Mario Rossi" data-description="Direttore Generale">Mario Rossi</div>
                            <div class="assignee-suggestion" data-name="Anna Bianchi" data-description="Dirigente Amministrativo">Anna Bianchi</div>
                            <div class="assignee-suggestion" data-name="Giuseppe Verdi" data-description="Capo Ufficio">Giuseppe Verdi</div>
                            <div class="assignee-suggestion" data-name="Maria Neri" data-description="Dirigente Tecnico">Maria Neri</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-danger bg-opacity-10">
                            <small><strong><i class="fas fa-shield-alt"></i> Forze Ordine</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="assignee-suggestion" data-name="Commissario Capo Luigi Esposito" data-description="Commissario Capo Polizia di Stato">Commissario Capo</div>
                            <div class="assignee-suggestion" data-name="Ispettore Marco Ferrari" data-description="Ispettore Superiore">Ispettore Ferrari</div>
                            <div class="assignee-suggestion" data-name="Sovrintendente Paolo Conti" data-description="Sovrintendente Capo">Sovrintendente Conti</div>
                            <div class="assignee-suggestion" data-name="Capitano Andrea Romano" data-description="Capitano Carabinieri">Capitano Romano</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-info bg-opacity-10">
                            <small><strong><i class="fas fa-building"></i> Uffici</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="assignee-suggestion" data-name="Ufficio Tecnico" data-description="Servizio manutenzioni e lavori pubblici">Ufficio Tecnico</div>
                            <div class="assignee-suggestion" data-name="Servizio Amministrativo" data-description="Gestione pratiche e protocollo">Servizio Amministrativo</div>
                            <div class="assignee-suggestion" data-name="Reparto Operativo" data-description="Attività operative sul territorio">Reparto Operativo</div>
                            <div class="assignee-suggestion" data-name="Ufficio Stampa" data-description="Comunicazione e relazioni esterne">Ufficio Stampa</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-success bg-opacity-10">
                            <small><strong><i class="fas fa-users"></i> Servizi</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="assignee-suggestion" data-name="Servizio Sociale" data-description="Assistenza e servizi ai cittadini">Servizio Sociale</div>
                            <div class="assignee-suggestion" data-name="Servizio Ambiente" data-description="Tutela ambientale e verde pubblico">Servizio Ambiente</div>
                            <div class="assignee-suggestion" data-name="Servizio Cultura" data-description="Attività culturali e turistiche">Servizio Cultura</div>
                            <div class="assignee-suggestion" data-name="Servizio Trasporti" data-description="Mobilità e trasporto pubblico">Servizio Trasporti</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group mb-2 ">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="3" placeholder="Note aggiuntive sull'assegnazione">{{ old('note', $carAssignee?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Motivazioni dell'assegnazione, condizioni particolari, ecc.</small>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('car-assignees.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>

<style>
.assignee-suggestion {
    cursor: pointer;
    padding: 5px;
    border-radius: 3px;
    font-size: 0.85rem;
    margin-bottom: 2px;
    transition: background-color 0.2s;
}
.assignee-suggestion:hover {
    background-color: rgba(0,123,255,0.1);
    color: #0056b3;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carSelect = document.getElementById('car_id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');
    
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewIcon = document.getElementById('preview-icon');
    const previewVehicle = document.getElementById('preview-vehicle');
    const previewPeriod = document.getElementById('preview-period');
    
    const overlapCheck = document.getElementById('overlap-check');
    const overlapWarning = document.getElementById('overlap-warning');
    const overlapMessage = document.getElementById('overlap-message');
    const overlapWarningMessage = document.getElementById('overlap-warning-message');
    
    // Gestisci i suggerimenti cliccabili
    document.querySelectorAll('.assignee-suggestion').forEach(suggestion => {
        suggestion.addEventListener('click', function() {
            const name = this.dataset.name;
            const description = this.dataset.description;
            
            nameInput.value = name;
            descriptionInput.value = description;
            
            updatePreview();
            
            // Evidenzia temporaneamente la selezione
            this.style.backgroundColor = '#007bff';
            this.style.color = 'white';
            setTimeout(() => {
                this.style.backgroundColor = '';
                this.style.color = '';
            }, 500);
        });
    });
    
    // Aggiorna anteprima in tempo reale
    function updatePreview() {
        const name = nameInput.value || 'Nome Assegnatario';
        const description = descriptionInput.value || 'Descrizione assegnatario';
        const selectedCar = carSelect.options[carSelect.selectedIndex];
        const carText = selectedCar.value ? selectedCar.text : 'Seleziona veicolo';
        
        previewName.textContent = name;
        previewDescription.textContent = description;
        previewVehicle.textContent = carText;
        
        // Aggiorna periodo
        const dateFrom = dateFromInput.value;
        const dateTo = dateToInput.value;
        let periodText = 'Periodo assegnazione';
        
        if (dateFrom) {
            const fromDate = new Date(dateFrom).toLocaleDateString('it-IT');
            if (dateTo) {
                const toDate = new Date(dateTo).toLocaleDateString('it-IT');
                periodText = `Dal ${fromDate} al ${toDate}`;
            } else {
                periodText = `Dal ${fromDate} (in corso)`;
            }
        }
        
        previewPeriod.textContent = periodText;
        
        // Aggiorna icona in base al nome
        updateIcon(name.toLowerCase());
        
        // Controlla sovrapposizioni
        if (carSelect.value && dateFromInput.value) {
            checkOverlaps();
        }
    }
    
    function updateIcon(assigneeName) {
        let iconClass = 'fas fa-user text-secondary';
        let bgClass = 'bg-secondary bg-opacity-10';
        
        if (assigneeName.includes('direttore') || assigneeName.includes('dirigente') || assigneeName.includes('capo')) {
            iconClass = 'fas fa-user-tie text-primary';
            bgClass = 'bg-primary bg-opacity-10';
        } else if (assigneeName.includes('commissario') || assigneeName.includes('ispettore') || assigneeName.includes('sovrintendente') || assigneeName.includes('capitano')) {
            iconClass = 'fas fa-shield-alt text-danger';
            bgClass = 'bg-danger bg-opacity-10';
        } else if (assigneeName.includes('ufficio') || assigneeName.includes('servizio') || assigneeName.includes('reparto')) {
            iconClass = 'fas fa-building text-info';
            bgClass = 'bg-info bg-opacity-10';
        }
        
        previewIcon.className = `assignee-icon d-flex align-items-center justify-content-center ${bgClass} rounded-circle me-3`;
        previewIcon.innerHTML = `<i class="${iconClass} fa-2x"></i>`;
    }
    
    function checkOverlaps() {
        // Simulazione controllo sovrapposizioni (in una app reale faresti una chiamata AJAX)
        const carId = carSelect.value;
        const dateFrom = dateFromInput.value;
        const dateTo = dateToInput.value || '9999-12-31';
        
        // Reset alerts
        overlapCheck.style.display = 'none';
        overlapWarning.style.display = 'none';
        
        if (Math.random() > 0.7) { // Simula una sovrapposizione nel 30% dei casi
            overlapWarning.style.display = 'block';
            overlapWarningMessage.textContent = 'Attenzione: il veicolo potrebbe essere già assegnato in questo periodo.';
        } else {
            overlapCheck.style.display = 'block';
            overlapMessage.textContent = 'Nessuna sovrapposizione rilevata per questo periodo.';
        }
    }
    
    // Ascolta i cambiamenti negli input
    carSelect.addEventListener('change', updatePreview);
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    dateFromInput.addEventListener('change', updatePreview);
    dateToInput.addEventListener('change', updatePreview);
    
    // Inizializza anteprima se stiamo modificando
    updatePreview();
});
</script>