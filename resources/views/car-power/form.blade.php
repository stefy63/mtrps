<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carPower?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $carPower?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>