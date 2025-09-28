<div class="row padding-1 p-1">
    <div class="col-md-12">

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

    </div>
    @if($button)
        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            <a href="{{ route('car-powers.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>
    @endif
</div>

