<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_id" class="form-control @error('car_id') is-invalid @enderror" value="{{ old('car_id', $carPlate?->car_id) }}" id="car_id" placeholder="Car Id">
            <label for="car_id" class="form-label">{{ __('Car Id') }}</label>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carPlate?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $carPlate?->type) }}" id="type" placeholder="Type">
            <label for="type" class="form-label">{{ __('Type') }}</label>
            {!! $errors->first('type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from', $carPlate?->date_from) }}" id="date_from" placeholder="Date From">
            <label for="date_from" class="form-label">{{ __('Date From') }}</label>
            {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to', $carPlate?->date_to) }}" id="date_to" placeholder="Date To">
            <label for="date_to" class="form-label">{{ __('Date To') }}</label>
            {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $carPlate?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>