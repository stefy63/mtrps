<div class="row padding-1 p-1">
    
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome Proprietario') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  id="name" placeholder="Nome del proprietario (es. Ministero dell'Interno, Comune di Roma)">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il nome completo dell'ente o organizzazione proprietaria</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="2" placeholder="Descrizione del proprietario"></textarea>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Breve descrizione del tipo di ente, settore di attività, ecc.</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="4" placeholder="Note aggiuntive sul proprietario"></textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni aggiuntive, contatti, specifiche particolari, ecc.</small>
        </div>

    </div>
</div>
