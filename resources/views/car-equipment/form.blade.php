<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_id" class="form-control @error('car_id') is-invalid @enderror" value="{{ old('car_id', $carEquipment?->car_id) }}" id="car_id" placeholder="Car Id">
            <label for="car_id" class="form-label">{{ __('Car Id') }}</label>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $carEquipment?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $carEquipment?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from', $carEquipment?->date_from) }}" id="date_from" placeholder="Date From">
            <label for="date_from" class="form-label">{{ __('Date From') }}</label>
            {!! $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to', $carEquipment?->date_to) }}" id="date_to" placeholder="Date To">
            <label for="date_to" class="form-label">{{ __('Date To') }}</label>
            {!! $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $carEquipment?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>