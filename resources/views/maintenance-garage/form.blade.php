<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="maintenance_id" class="form-control @error('maintenance_id') is-invalid @enderror" value="{{ old('maintenance_id', $maintenanceGarage?->maintenance_id) }}" id="maintenance_id" placeholder="Maintenance Id">
            <label for="maintenance_id" class="form-label">{{ __('Maintenance Id') }}</label>
            {!! $errors->first('maintenance_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $maintenanceGarage?->name) }}" id="name" placeholder="Name">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="piva" class="form-control @error('piva') is-invalid @enderror" value="{{ old('piva', $maintenanceGarage?->piva) }}" id="piva" placeholder="Piva">
            <label for="piva" class="form-label">{{ __('Piva') }}</label>
            {!! $errors->first('piva', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="cf" class="form-control @error('cf') is-invalid @enderror" value="{{ old('cf', $maintenanceGarage?->cf) }}" id="cf" placeholder="Cf">
            <label for="cf" class="form-label">{{ __('Cf') }}</label>
            {!! $errors->first('cf', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="iban" class="form-control @error('iban') is-invalid @enderror" value="{{ old('iban', $maintenanceGarage?->iban) }}" id="iban" placeholder="Iban">
            <label for="iban" class="form-label">{{ __('Iban') }}</label>
            {!! $errors->first('iban', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="pec" class="form-control @error('pec') is-invalid @enderror" value="{{ old('pec', $maintenanceGarage?->pec) }}" id="pec" placeholder="Pec">
            <label for="pec" class="form-label">{{ __('Pec') }}</label>
            {!! $errors->first('pec', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="acc" class="form-control @error('acc') is-invalid @enderror" value="{{ old('acc', $maintenanceGarage?->acc) }}" id="acc" placeholder="Acc">
            <label for="acc" class="form-label">{{ __('Acc') }}</label>
            {!! $errors->first('acc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="anti_mafia" class="form-control @error('anti_mafia') is-invalid @enderror" value="{{ old('anti_mafia', $maintenanceGarage?->anti_mafia) }}" id="anti_mafia" placeholder="Anti Mafia">
            <label for="anti_mafia" class="form-label">{{ __('Anti Mafia') }}</label>
            {!! $errors->first('anti_mafia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="durc" class="form-control @error('durc') is-invalid @enderror" value="{{ old('durc', $maintenanceGarage?->durc) }}" id="durc" placeholder="Durc">
            <label for="durc" class="form-label">{{ __('Durc') }}</label>
            {!! $errors->first('durc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $maintenanceGarage?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $maintenanceGarage?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>