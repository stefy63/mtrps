@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="ente" class="form-control @error('ente') is-invalid @enderror" value="{{ old('ente', $office?->ente) }}" id="ente" placeholder="Ente">
            <label for="ente" class="form-label">{{ __('Ente') }}</label>
            {!! $errors->first('ente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $office?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $office?->phone) }}" id="phone" placeholder="Phone">
            <label for="phone" class="form-label">{{ __('Phone') }}</label>
            {!! $errors->first('phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', $office?->mail) }}" id="mail" placeholder="Mail">
            <label for="mail" class="form-label">{{ __('Mail') }}</label>
            {!! $errors->first('mail', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $office?->address) }}" id="address" placeholder="Address">
            <label for="address" class="form-label">{{ __('Address') }}</label>
            {!! $errors->first('address', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $office?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $office?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Ufficio') }}
        </button>
        <a href="{{ route('offices.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>