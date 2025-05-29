<div class="row padding-1 p-1">
    
    <!-- Anteprima Proprietario -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Anteprima Proprietario</h6>
            </div>
            <div class="card-body">
                <div id="owner-preview" class="d-flex align-items-center">
                    <div id="preview-icon" class="owner-icon d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-user text-secondary fa-2x"></i>
                    </div>
                    <div>
                        <h5 id="preview-name" class="mb-1 text-primary">Nome Proprietario</h5>
                        <p id="preview-description" class="mb-1 text-muted">Descrizione proprietario</p>
                        <span id="preview-badge" class="badge badge-secondary">Generico</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome Proprietario') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carOwner?->name) }}" id="name" placeholder="Nome del proprietario (es. Ministero dell'Interno, Comune di Roma)">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il nome completo dell'ente o organizzazione proprietaria</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="2" placeholder="Descrizione del proprietario">{{ old('description', $carOwner?->description) }}</textarea>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Breve descrizione del tipo di ente, settore di attività, ecc.</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="4" placeholder="Note aggiuntive sul proprietario">{{ old('note', $carOwner?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni aggiuntive, contatti, specifiche particolari, ecc.</small>
        </div>

        <!-- Suggerimenti per categorie -->
        <div class="form-group mb-3">
            <label class="form-label">Suggerimenti per categoria:</label>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary bg-opacity-10">
                            <small><strong><i class="fas fa-landmark"></i> Enti Statali</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="owner-suggestion" data-name="Ministero dell'Interno" data-description="Dicastero responsabile per ordine pubblico e sicurezza">Ministero dell'Interno</div>
                            <div class="owner-suggestion" data-name="Ministero della Difesa" data-description="Forze armate e difesa nazionale">Ministero della Difesa</div>
                            <div class="owner-suggestion" data-name="Presidenza del Consiglio" data-description="Organo di coordinamento dell'azione governativa">Presidenza del Consiglio</div>
                            <div class="owner-suggestion" data-name="Agenzia delle Entrate" data-description="Ente pubblico per la riscossione fiscale">Agenzia delle Entrate</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-info bg-opacity-10">
                            <small><strong><i class="fas fa-city"></i> Enti Locali</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="owner-suggestion" data-name="Comune di Roma" data-description="Amministrazione comunale della Capitale">Comune di Roma</div>
                            <div class="owner-suggestion" data-name="Provincia di Milano" data-description="Ente territoriale della Lombardia">Provincia di Milano</div>
                            <div class="owner-suggestion" data-name="Regione Lazio" data-description="Ente regionale del Lazio">Regione Lazio</div>
                            <div class="owner-suggestion" data-name="Città Metropolitana di Torino" data-description="Ente di area vasta del Piemonte">Città Metropolitana di Torino</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-danger bg-opacity-10">
                            <small><strong><i class="fas fa-shield-alt"></i> Forze dell'Ordine</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="owner-suggestion" data-name="Polizia di Stato" data-description="Forza di polizia civile ad ordinamento civile">Polizia di Stato</div>
                            <div class="owner-suggestion" data-name="Arma dei Carabinieri" data-description="Forza armata e di polizia ad ordinamento militare">Arma dei Carabinieri</div>
                            <div class="owner-suggestion" data-name="Guardia di Finanza" data-description="Corpo di polizia economico-finanziaria">Guardia di Finanza</div>
                            <div class="owner-suggestion" data-name="Polizia Municipale" data-description="Corpo di polizia locale">Polizia Municipale</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-success bg-opacity-10">
                            <small><strong><i class="fas fa-building"></i> Enti Privati</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="owner-suggestion" data-name="Azienda Trasporti SPA" data-description="Società privata di trasporti">Azienda Trasporti SPA</div>
                            <div class="owner-suggestion" data-name="Società di Servizi SRL" data-description="Impresa privata di servizi">Società di Servizi SRL</div>
                            <div class="owner-suggestion" data-name="Cooperativa Sociale" data-description="Ente del terzo settore">Cooperativa Sociale</div>
                            <div class="owner-suggestion" data-name="Fondazione Privata" data-description="Ente senza scopo di lucro">Fondazione Privata</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('car-owners.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>

<style>
.owner-suggestion {
    cursor: pointer;
    padding: 5px;
    border-radius: 3px;
    font-size: 0.85rem;
    margin-bottom: 2px;
    transition: background-color 0.2s;
}
.owner-suggestion:hover {
    background-color: rgba(0,123,255,0.1);
    color: #0056b3;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewIcon = document.getElementById('preview-icon');
    const previewBadge = document.getElementById('preview-badge');
    
    // Gestisci i suggerimenti cliccabili
    document.querySelectorAll('.owner-suggestion').forEach(suggestion => {
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
        const name = nameInput.value || 'Nome Proprietario';
        const description = descriptionInput.value || 'Descrizione proprietario';
        
        previewName.textContent = name;
        previewDescription.textContent = description;
        
        // Aggiorna icona e badge in base al nome
        updateIconAndBadge(name.toLowerCase());
    }
    
    function updateIconAndBadge(ownerName) {
        let iconClass = 'fas fa-user text-secondary';
        let bgClass = 'bg-secondary bg-opacity-10';
        let badge = 'Generico';
        let badgeClass = 'secondary';
        
        if (ownerName.includes('stato') || ownerName.includes('ministero') || ownerName.includes('governo') || ownerName.includes('agenzia')) {
            iconClass = 'fas fa-landmark text-primary';
            bgClass = 'bg-primary bg-opacity-10';
            badge = 'Pubblico';
            badgeClass = 'primary';
        } else if (ownerName.includes('comune') || ownerName.includes('provincia') || ownerName.includes('regione') || ownerName.includes('città')) {
            iconClass = 'fas fa-city text-info';
            bgClass = 'bg-info bg-opacity-10';
            badge = 'Ente Locale';
            badgeClass = 'info';
        } else if (ownerName.includes('polizia') || ownerName.includes('carabinieri') || ownerName.includes('guardia') || ownerName.includes('arma')) {
            iconClass = 'fas fa-shield-alt text-danger';
            bgClass = 'bg-danger bg-opacity-10';
            badge = 'Forze Ordine';
            badgeClass = 'danger';
        } else if (ownerName.includes('azienda') || ownerName.includes('spa') || ownerName.includes('srl') || ownerName.includes('società')) {
            iconClass = 'fas fa-building text-success';
            bgClass = 'bg-success bg-opacity-10';
            badge = 'Privato';
            badgeClass = 'success';
        }
        
        previewIcon.className = `owner-icon d-flex align-items-center justify-content-center ${bgClass} rounded-circle me-3`;
        previewIcon.innerHTML = `<i class="${iconClass} fa-2x"></i>`;
        
        previewBadge.className = `badge badge-${badgeClass}`;
        previewBadge.textContent = badge;
    }
    
    // Ascolta i cambiamenti negli input
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    
    // Inizializza anteprima se stiamo modificando
    updatePreview();
});
</script>