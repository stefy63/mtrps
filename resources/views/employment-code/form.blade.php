@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 ">
            <label for="code" class="form-label">{{ __('Codice numerico') }} <span class="text-danger">*</span></label>
            <input type="number" name="code" class="form-control @error('code') is-invalid @enderror"
                   value="{{ old('name', $carEmploymentCode?->code) }}" id="code">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Inserisci il codice numerico di impiego</small>
        </div>

        <div class="form-group mb-2 ">
            <label for="description" class="form-label">{{ __('Descrizione') }} <span class="text-danger">*</span></label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $carEmploymentCode?->description) }}" id="description">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="form-text text-muted">Descrizione del codice di impiego</small>
        </div>

{{--        <div class="form-group mb-2 ">--}}
{{--            <label for="note" class="form-label">{{ __('Note') }}</label>--}}
{{--            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="4"--}}
{{--                      placeholder="Note aggiuntive sulla marca">{{ old('note', $carEmploymentCode?->note) }}</textarea>--}}
{{--            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--            <small class="form-text text-muted">Informazioni aggiuntive, caratteristiche particolari, storia della--}}
{{--                marca, ecc.</small>--}}
{{--        </div>--}}

    </div>
    @if($button)
        <div class="col-md-12 mt20 mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            <a href="{{ route('employment-code.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>
    @endif
</div>

