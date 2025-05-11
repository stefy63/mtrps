<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_type_id" class="form-control @error('car_type_id') is-invalid @enderror" value="{{ old('car_type_id', $car?->car_type_id) }}" id="car_type_id" placeholder="Car Type Id">
            <label for="car_type_id" class="form-label">{{ __('Car Type Id') }}</label>
            {!! $errors->first('car_type_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_owner_id" class="form-control @error('car_owner_id') is-invalid @enderror" value="{{ old('car_owner_id', $car?->car_owner_id) }}" id="car_owner_id" placeholder="Car Owner Id">
            <label for="car_owner_id" class="form-label">{{ __('Car Owner Id') }}</label>
            {!! $errors->first('car_owner_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_brand_id" class="form-control @error('car_brand_id') is-invalid @enderror" value="{{ old('car_brand_id', $car?->car_brand_id) }}" id="car_brand_id" placeholder="Car Brand Id">
            <label for="car_brand_id" class="form-label">{{ __('Car Brand Id') }}</label>
            {!! $errors->first('car_brand_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_power_id" class="form-control @error('car_power_id') is-invalid @enderror" value="{{ old('car_power_id', $car?->car_power_id) }}" id="car_power_id" placeholder="Car Power Id">
            <label for="car_power_id" class="form-label">{{ __('Car Power Id') }}</label>
            {!! $errors->first('car_power_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_profit_account_id" class="form-control @error('car_profit_account_id') is-invalid @enderror" value="{{ old('car_profit_account_id', $car?->car_profit_account_id) }}" id="car_profit_account_id" placeholder="Car Profit Account Id">
            <label for="car_profit_account_id" class="form-label">{{ __('Car Profit Account Id') }}</label>
            {!! $errors->first('car_profit_account_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $car?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model', $car?->model) }}" id="model" placeholder="Model">
            <label for="model" class="form-label">{{ __('Model') }}</label>
            {!! $errors->first('model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $car?->color) }}" id="color" placeholder="Color">
            <label for="color" class="form-label">{{ __('Color') }}</label>
            {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="cod_model" class="form-control @error('cod_model') is-invalid @enderror" value="{{ old('cod_model', $car?->cod_model) }}" id="cod_model" placeholder="Cod Model">
            <label for="cod_model" class="form-label">{{ __('Cod Model') }}</label>
            {!! $errors->first('cod_model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="profit_account" class="form-control @error('profit_account') is-invalid @enderror" value="{{ old('profit_account', $car?->profit_account) }}" id="profit_account" placeholder="Profit Account">
            <label for="profit_account" class="form-label">{{ __('Profit Account') }}</label>
            {!! $errors->first('profit_account', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="tank" class="form-control @error('tank') is-invalid @enderror" value="{{ old('tank', $car?->tank) }}" id="tank" placeholder="Tank">
            <label for="tank" class="form-label">{{ __('Tank') }}</label>
            {!! $errors->first('tank', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="km" class="form-control @error('km') is-invalid @enderror" value="{{ old('km', $car?->km) }}" id="km" placeholder="Km">
            <label for="km" class="form-label">{{ __('Km') }}</label>
            {!! $errors->first('km', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $car?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="winter_wheels" class="form-control @error('winter_wheels') is-invalid @enderror" value="{{ old('winter_wheels', $car?->winter_wheels) }}" id="winter_wheels" placeholder="Winter Wheels">
            <label for="winter_wheels" class="form-label">{{ __('Winter Wheels') }}</label>
            {!! $errors->first('winter_wheels', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="wheels_type" class="form-control @error('wheels_type') is-invalid @enderror" value="{{ old('wheels_type', $car?->wheels_type) }}" id="wheels_type" placeholder="Wheels Type">
            <label for="wheels_type" class="form-label">{{ __('Wheels Type') }}</label>
            {!! $errors->first('wheels_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="warranty" class="form-control @error('warranty') is-invalid @enderror" value="{{ old('warranty', $car?->warranty) }}" id="warranty" placeholder="Warranty">
            <label for="warranty" class="form-label">{{ __('Warranty') }}</label>
            {!! $errors->first('warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="tel_warranty" class="form-control @error('tel_warranty') is-invalid @enderror" value="{{ old('tel_warranty', $car?->tel_warranty) }}" id="tel_warranty" placeholder="Tel Warranty">
            <label for="tel_warranty" class="form-label">{{ __('Tel Warranty') }}</label>
            {!! $errors->first('tel_warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="chassis" class="form-control @error('chassis') is-invalid @enderror" value="{{ old('chassis', $car?->chassis) }}" id="chassis" placeholder="Chassis">
            <label for="chassis" class="form-label">{{ __('Chassis') }}</label>
            {!! $errors->first('chassis', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date_revision" class="form-control @error('date_revision') is-invalid @enderror" value="{{ old('date_revision', $car?->date_revision) }}" id="date_revision" placeholder="Date Revision">
            <label for="date_revision" class="form-label">{{ __('Date Revision') }}</label>
            {!! $errors->first('date_revision', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="doc" class="form-control @error('doc') is-invalid @enderror" value="{{ old('doc', $car?->doc) }}" id="doc" placeholder="Doc">
            <label for="doc" class="form-label">{{ __('Doc') }}</label>
            {!! $errors->first('doc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $car?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>