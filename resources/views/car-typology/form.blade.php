@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Tipologia Vettura') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carTypology?->name) }}" id="name" >
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci la tipologia di vettura</small>
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <input name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $carTypology?->description) }}" id="description" placeholder="Descrizione della tipologia di vettura">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Caratteristiche, vantaggi e specifiche tecniche</small>
        </div>

    </div>
    @if($button)
        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Salva') }}</button>
            <a href="{{ route('car-typology.index') }}" class="btn btn-secondary">{{ __('Annulla') }}</a>
        </div>
    @endif
</div>

