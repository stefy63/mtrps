<div class="row padding-1 p-1">
    <div class="col-md-6">

        <x-dynamic-select
                required
                name="car_type_id"
                :required="'true'"
                :value="old('car_type_id', $car?->car_type_id)"
                :options="$carTypes"
                :errors="$errors"
                endpoint="{{ route('car-types.storeForm') }}"
                label="{{ __('Tipo Veicolo') }}"
                labelKey="name"
                idKey="id"
                modal-url="{{ route('car-types.getForm') }}"
                modal-title="Nuova Tipologia di vettura"
        />

        <x-dynamic-select
                required
                name="car_owner_id"
                :required="'true'"
                :value="old('car_owner_id', $car?->car_owner_id)"
                :options="$carOwners"
                :errors="$errors"
                endpoint="{{ route('car-owners.storeForm') }}"
                label="{{ __('Proprietario') }}"
                labelKey="name"
                idKey="id"
                modal-url="{{ route('car-owners.getForm') }}"
                modal-title="Nuovo proprietario"
        />

        <x-dynamic-select
                name="car_brand_id"
                :required="'false'"
                :value="old('car_brand_id', $car?->car_brand_id)"
                :options="$carBrands"
                :errors="$errors"
                endpoint="{{ route('car-brands.storeForm') }}"
                label="{{ __('Marca') }}"
                labelKey="name"
                idKey="id"
                modal-url="{{ route('car-brands.getForm') }}"
                modal-title="Nuova Marca"
        />

        <x-dynamic-select
                name="car_power_id"
                :required="'false'"
                :value="old('car_power_id', $car?->car_power_id)"
                :options="$carPowers"
                :errors="$errors"
                endpoint="{{ route('car-powers.storeForm') }}"
                label="{{ __('Alimentazione') }}"
                labelKey="name"
                idKey="id"
                modal-url="{{ route('car-powers.getForm') }}"
                modal-title="Nuovo tipo di alimentazione"
        />

        <x-dynamic-select
                name="car_profit_account_id"
                modalClass="modal-xl"
                :required="'false'"
                :value="old('car_profit_account_id', $car?->car_profit_account_id)"
                :options="$carProfitAccounts"
                :errors="$errors"
                endpoint="{{ route('car-profit-accounts.storeForm') }}"
                label="{{ __('Conto Economico') }}"
                labelKey="name"
                idKey="id"
                modal-url="{{ route('car-profit-accounts.getForm') }}"
                modal-title="Nuovo conto economico"
        />

        <x-dynamic-select
                name="car_employment_code_id"
                :required="'false'"
                :value="old('car_employment_code_id', $car?->car_employment_code_id)"
                :options="$carEmployment"
                :errors="$errors"
                endpoint="{{ route('home') }}"
                label="{{ __('Codice di impiego') }}"
                labelKey="extended"
                idKey="id"
                modal-url="{{ route('home') }}"
                modal-title="Nuovo codice di impiego"
        />

{{--        <div class="form-group mb-2 mb20">--}}
{{--            <label for="car_profit_account_id" class="form-label">{{ __('Conto Economico') }}</label>--}}
{{--            <select name="car_profit_account_id"--}}
{{--                    class="form-control @error('car_profit_account_id') is-invalid @enderror"--}}
{{--                    id="car_profit_account_id">--}}
{{--                <option value="">Seleziona conto economico</option>--}}
{{--                @foreach($carProfitAccounts as $id => $name)--}}
{{--                    <option value="{{ $id }}" {{ old('car_profit_account_id', $car?->car_profit_account_id) == $id ? 'selected' : '' }}>--}}
{{--                        {{ $name }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--            {!! $errors->first('car_profit_account_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}--}}
{{--        </div>--}}

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nome') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $car?->name) }}" id="name" placeholder="Nome veicolo">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="model" class="form-label">{{ __('Modello') }}</label>
            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"
                   value="{{ old('model', $car?->model) }}" id="model" placeholder="Modello">
            {!! $errors->first('model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="color" class="form-label">{{ __('Colore') }}</label>
            <input type="text" name="color" class="form-control @error('color') is-invalid @enderror"
                   value="{{ old('color', $car?->color) }}" id="color" placeholder="Colore">
            {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="cod_model" class="form-label">{{ __('Codice Modello') }}</label>
            <input type="text" name="cod_model" class="form-control @error('cod_model') is-invalid @enderror"
                   value="{{ old('cod_model', $car?->cod_model) }}" id="cod_model" placeholder="Codice modello">
            {!! $errors->first('cod_model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group mb-2 mb20">
            <label for="profit_account" class="form-label">{{ __('Conto Profitto') }}</label>
            <input type="text" name="profit_account"
                   class="form-control @error('profit_account') is-invalid @enderror"
                   value="{{ old('profit_account', $car?->profit_account) }}" id="profit_account"
                   placeholder="Conto profitto">
            {!! $errors->first('profit_account', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="tank" class="form-label">{{ __('Serbatoio (L)') }}</label>
            <input type="number" name="tank" class="form-control @error('tank') is-invalid @enderror"
                   value="{{ old('tank', $car?->tank) }}" id="tank" placeholder="Capacità serbatoio in litri"
                   min="0">
            {!! $errors->first('tank', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="km" class="form-label">{{ __('Chilometraggio') }}</label>
            <input type="number" name="km" class="form-control @error('km') is-invalid @enderror"
                   value="{{ old('km', $car?->km) }}" id="km" placeholder="Chilometri percorsi" min="0">
            {!! $errors->first('km', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="winter_wheels" class="form-label">{{ __('Pneumatici Invernali') }}</label>
            <div class="form-check">
                <input type="hidden" name="winter_wheels" value="0">
                <input type="checkbox" name="winter_wheels"
                       class="form-check-input @error('winter_wheels') is-invalid @enderror" value="1"
                       id="winter_wheels" {{ old('winter_wheels', $car?->winter_wheels) ? 'checked' : '' }}>
                <label class="form-check-label" for="winter_wheels">
                    Dotato di pneumatici invernali
                </label>
            </div>
            {!! $errors->first('winter_wheels', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="wheels_type" class="form-label">{{ __('Tipo Pneumatici') }}</label>
            <input type="text" name="wheels_type" class="form-control @error('wheels_type') is-invalid @enderror"
                   value="{{ old('wheels_type', $car?->wheels_type) }}" id="wheels_type"
                   placeholder="Tipo pneumatici">
            {!! $errors->first('wheels_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="warranty" class="form-label">{{ __('Garanzia') }}</label>
            <input type="text" name="warranty" class="form-control @error('warranty') is-invalid @enderror"
                   value="{{ old('warranty', $car?->warranty) }}" id="warranty" placeholder="Informazioni garanzia">
            {!! $errors->first('warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="tel_warranty" class="form-label">{{ __('Telefono Assistenza') }}</label>
            <input type="text" name="tel_warranty" class="form-control @error('tel_warranty') is-invalid @enderror"
                   value="{{ old('tel_warranty', $car?->tel_warranty) }}" id="tel_warranty"
                   placeholder="Numero assistenza">
            {!! $errors->first('tel_warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="chassis" class="form-label">{{ __('Telaio') }}</label>
            <input type="text" name="chassis" class="form-control @error('chassis') is-invalid @enderror"
                   value="{{ old('chassis', $car?->chassis) }}" id="chassis" placeholder="Numero telaio">
            {!! $errors->first('chassis', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="date_revision" class="form-label">{{ __('Data Revisione') }}</label>
            <input type="date" name="date_revision"
                   class="form-control @error('date_revision') is-invalid @enderror"
                   value="{{ old('date_revision', $car?->date_revision) }}" id="date_revision">
            {!! $errors->first('date_revision', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="doc" class="form-label">{{ __('Data Documento') }}</label>
            <input type="date" name="doc" class="form-control @error('doc') is-invalid @enderror"
                   value="{{ old('doc', $car?->doc) }}" id="doc">
            {!! $errors->first('doc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $car?->description) }}" id="description"
                   placeholder="Descrizione veicolo">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="note" class="form-label">{{ __('Note') }}</label>
            <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note" rows="3"
                      placeholder="Note aggiuntive">{{ old('note', $car?->note) }}</textarea>
            {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>
