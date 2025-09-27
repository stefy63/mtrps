<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nome tipologia veicolo (es. Berlina, SUV, Furgone)">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il nome della tipologia di veicolo (es. Berlina, SUV, Furgone, Motocicletta, ecc.)</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Descrizione della tipologia">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Breve descrizione della tipologia di veicolo</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="4" placeholder="Note aggiuntive sulla tipologia"></textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Note aggiuntive, caratteristiche particolari o specifiche tecniche</small>
        </div>

    </div>
</div>

