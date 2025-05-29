<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <!-- Anteprima icona dinamica -->
        <div class="form-group mb-3">
            <label class="form-label">Anteprima Alimentazione</label>
            <div id="power-preview" class="d-flex align-items-center p-3 border rounded bg-light">
                <div id="preview-icon" class="power-icon d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded me-3" style="width: 50px; height: 50px;">
                    <i class="fas fa-cog text-muted"></i>
                </div>
                <div>
                    <h5 id="preview-name" class="mb-1 text-primary">Nome alimentazione</h5>
                    <small id="preview-description" class="text-muted">Descrizione alimentazione</small>
                </div>
            </div>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome Alimentazione') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carPower?->name) }}" id="name" placeholder="Nome dell'alimentazione (es. Benzina, Diesel, Elettrico)">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il tipo di alimentazione del veicolo</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" placeholder="Descrizione dettagliata dell'alimentazione">{{ old('description', $carPower?->description) }}</textarea>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Caratteristiche, vantaggi e specifiche tecniche</small>
        </div>

        <!-- Suggerimenti per categorie -->
        <div class="form-group mb-3">
            <label class="form-label">Suggerimenti per categoria:</label>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-warning bg-opacity-10">
                            <small><strong>Combustibili Fossili</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="power-suggestion" data-name="Benzina" data-description="Carburante tradizionale a base di idrocarburi, alta efficienza energetica">Benzina</div>
                            <div class="power-suggestion" data-name="Diesel" data-description="Gasolio con maggiore efficienza nei consumi, ideale per lunghe percorrenze">Diesel</div>
                            <div class="power-suggestion" data-name="Gasolio" data-description="Combustibile diesel per veicoli commerciali e industriali">Gasolio</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-success bg-opacity-10">
                            <small><strong>Eco-Friendly</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="power-suggestion" data-name="Elettrico" data-description="Motore elettrico a zero emissioni locali, alimentato da batterie">Elettrico</div>
                            <div class="power-suggestion" data-name="Ibrido" data-description="Combinazione di motore termico ed elettrico per ridotti consumi">Ibrido</div>
                            <div class="power-suggestion" data-name="Plug-in Hybrid" data-description="Ibrido ricaricabile con autonomia elettrica estesa">Plug-in Hybrid</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-info bg-opacity-10">
                            <small><strong>Gas</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="power-suggestion" data-name="GPL" data-description="Gas di Petrolio Liquefatto, minori emissioni e costi ridotti">GPL</div>
                            <div class="power-suggestion" data-name="Metano" data-description="Gas naturale compresso, basse emissioni e economico">Metano</div>
                            <div class="power-suggestion" data-name="CNG" data-description="Compressed Natural Gas per veicoli commerciali">CNG</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary bg-opacity-10">
                            <small><strong>Innovativi</strong></small>
                        </div>
                        <div class="card-body p-2">
                            <div class="power-suggestion" data-name="Idrogeno" data-description="Celle a combustibile a idrogeno, zero emissioni">Idrogeno</div>
                            <div class="power-suggestion" data-name="Biocarburante" data-description="Carburanti derivati da biomasse rinnovabili">Biocarburante</div>
                            <div class="power-suggestion" data-name="E-fuel" data-description="Carburanti sintetici prodotti con energia rinnovabile">E-fuel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('car-powers.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>

<style>
.power-suggestion {
    cursor: pointer;
    padding: 5px;
    border-radius: 3px;
    font-size: 0.85rem;
    margin-bottom: 2px;
    transition: background-color 0.2s;
}
.power-suggestion:hover {
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
    
    // Gestisci i suggerimenti cliccabili
    document.querySelectorAll('.power-suggestion').forEach(suggestion => {
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
        const name = nameInput.value || 'Nome alimentazione';
        const description = descriptionInput.value || 'Descrizione alimentazione';
        
        previewName.textContent = name;
        previewDescription.textContent = description;
        
        // Aggiorna icona in base al nome
        updateIcon(name.toLowerCase());
    }
    
    function updateIcon(powerName) {
        let iconClass = 'fas fa-cog text-muted';
        let bgClass = 'bg-secondary bg-opacity-10';
        
        if (powerName.includes('benzina')) {
            iconClass = 'fas fa-gas-pump text-warning';
            bgClass = 'bg-warning bg-opacity-10';
        } else if (powerName.includes('diesel') || powerName.includes('gasolio')) {
            iconClass = 'fas fa-oil-can text-dark';
            bgClass = 'bg-secondary bg-opacity-10';
        } else if (powerName.includes('elettric')) {
            iconClass = 'fas fa-bolt text-primary';
            bgClass = 'bg-primary bg-opacity-10';
        } else if (powerName.includes('ibrido') || powerName.includes('hybrid')) {
            iconClass = 'fas fa-leaf text-success';
            bgClass = 'bg-success bg-opacity-10';
        } else if (powerName.includes('gpl')) {
            iconClass = 'fas fa-fire text-info';
            bgClass = 'bg-info bg-opacity-10';
        } else if (powerName.includes('metano') || powerName.includes('cng')) {
            iconClass = 'fas fa-wind text-success';
            bgClass = 'bg-success bg-opacity-10';
        } else if (powerName.includes('idrogeno')) {
            iconClass = 'fas fa-atom text-primary';
            bgClass = 'bg-primary bg-opacity-10';
        }
        
        previewIcon.className = `power-icon d-flex align-items-center justify-content-center ${bgClass} rounded me-3`;
        previewIcon.innerHTML = `<i class="${iconClass}"></i>`;
    }
    
    // Ascolta i cambiamenti negli input
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    
    // Inizializza anteprima se stiamo modificando
    updatePreview();
});
</script>