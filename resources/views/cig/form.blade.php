<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-floating mb-2 mb20">
            <input type="text" name="car_id" class="form-control @error('car_id') is-invalid @enderror" value="{{ old('car_id', $cig?->car_id) }}" id="car_id" placeholder="Car Id">
            <label for="car_id" class="form-label">{{ __('Car Id') }}</label>
            {!! $errors->first('car_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="maintenance_garage_id" class="form-control @error('maintenance_garage_id') is-invalid @enderror" value="{{ old('maintenance_garage_id', $cig?->maintenance_garage_id) }}" id="maintenance_garage_id" placeholder="Maintenance Garage Id">
            <label for="maintenance_garage_id" class="form-label">{{ __('Maintenance Garage Id') }}</label>
            {!! $errors->first('maintenance_garage_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="user_rup_id" class="form-control @error('user_rup_id') is-invalid @enderror" value="{{ old('user_rup_id', $cig?->user_rup_id) }}" id="user_rup_id" placeholder="User Rup Id">
            <label for="user_rup_id" class="form-label">{{ __('User Rup Id') }}</label>
            {!! $errors->first('user_rup_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="user_support_id" class="form-control @error('user_support_id') is-invalid @enderror" value="{{ old('user_support_id', $cig?->user_support_id) }}" id="user_support_id" placeholder="User Support Id">
            <label for="user_support_id" class="form-label">{{ __('User Support Id') }}</label>
            {!! $errors->first('user_support_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="user_tender_notice_id" class="form-control @error('user_tender_notice_id') is-invalid @enderror" value="{{ old('user_tender_notice_id', $cig?->user_tender_notice_id) }}" id="user_tender_notice_id" placeholder="User Tender Notice Id">
            <label for="user_tender_notice_id" class="form-label">{{ __('User Tender Notice Id') }}</label>
            {!! $errors->first('user_tender_notice_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="user_tester_id" class="form-control @error('user_tester_id') is-invalid @enderror" value="{{ old('user_tester_id', $cig?->user_tester_id) }}" id="user_tester_id" placeholder="User Tester Id">
            <label for="user_tester_id" class="form-label">{{ __('User Tester Id') }}</label>
            {!! $errors->first('user_tester_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $cig?->date) }}" id="date" placeholder="Date">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            {!! $errors->first('date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="ce" class="form-control @error('ce') is-invalid @enderror" value="{{ old('ce', $cig?->ce) }}" id="ce" placeholder="Ce">
            <label for="ce" class="form-label">{{ __('Ce') }}</label>
            {!! $errors->first('ce', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $cig?->description) }}" id="description" placeholder="Description">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="preventive" class="form-control @error('preventive') is-invalid @enderror" value="{{ old('preventive', $cig?->preventive) }}" id="preventive" placeholder="Preventive">
            <label for="preventive" class="form-label">{{ __('Preventive') }}</label>
            {!! $errors->first('preventive', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="final_report" class="form-control @error('final_report') is-invalid @enderror" value="{{ old('final_report', $cig?->final_report) }}" id="final_report" placeholder="Final Report">
            <label for="final_report" class="form-label">{{ __('Final Report') }}</label>
            {!! $errors->first('final_report', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="taxable" class="form-control @error('taxable') is-invalid @enderror" value="{{ old('taxable', $cig?->taxable) }}" id="taxable" placeholder="Taxable">
            <label for="taxable" class="form-label">{{ __('Taxable') }}</label>
            {!! $errors->first('taxable', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="vat" class="form-control @error('vat') is-invalid @enderror" value="{{ old('vat', $cig?->vat) }}" id="vat" placeholder="Vat">
            <label for="vat" class="form-label">{{ __('Vat') }}</label>
            {!! $errors->first('vat', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="cig" class="form-control @error('cig') is-invalid @enderror" value="{{ old('cig', $cig?->cig) }}" id="cig" placeholder="Cig">
            <label for="cig" class="form-label">{{ __('Cig') }}</label>
            {!! $errors->first('cig', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-floating mb-2 mb20">
            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $cig?->note) }}" id="note" placeholder="Note">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>