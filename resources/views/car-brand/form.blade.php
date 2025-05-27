<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome Marca') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carBrand?->name) }}" id="name" placeholder="Nome della marca (es. Fiat, BMW, Mercedes)">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il nome ufficiale della casa automobilistica</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $carBrand?->description) }}" id="description" placeholder="Breve descrizione della marca">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni generali sulla marca (paese di origine, tipo di veicoli, ecc.)</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="4" placeholder="Note aggiuntive sulla marca">{{ old('note', $carBrand?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Informazioni aggiuntive, caratteristiche particolari, storia della marca, ecc.</small>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('car-brands.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>

