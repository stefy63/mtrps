@php($button = $button ?? true)
<div class="padding-1 p-1">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general" aria-selected="true">Generali
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="assigne-tab" data-bs-toggle="tab" data-bs-target="#assigne" type="button"
                    role="tab" aria-controls="assigne" aria-selected="false">Assegnazioni
            </button>
        </li>
    </ul>
    <div class="tab-content" id="carTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row pt-3">
                <div class="col-md-6">

                    <x-dynamic-select
                            name="car_brand_id"
                            :class="'mb-2'"
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
                            required
                            name="car_type_id"
                            :required="'true'"
                            :value="old('car_type_id', $car?->car_type_id)"
                            :options="$carTypes"
                            :errors="$errors"
                            endpoint="{{ route('car-types.storeForm') }}"
                            label="{{ __('Modello') }}"
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

                    <div class="form-group mb-2">
                        <label for="color" class="form-label">{{ __('Colore') }}</label>
                        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror"
                               value="{{ old('color', $car?->color) }}" id="color" placeholder="Colore">
                        {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="car_typology" class="form-label">{{ __('Tipologia di Mezzo') }}</label>
                        <input type="text" name="car_typology"
                               class="form-control @error('car_typology') is-invalid @enderror"
                               value="{{ old('car_typology', $car?->car_typology) }}" id="car_typology"
                               placeholder="Tipologia di Mezzo">
                        {!! $errors->first('car_typology', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20" style="margin-top: 1.3rem">
                        <label for="available" class="form-label">{{ __('Stato vettura') }}</label>
                        <div class="form-check">
                            <input type="hidden" name="available" value="0">
                            <input type="checkbox" name="available"
                                   class="form-check-input @error('available') is-invalid @enderror" value="1"
                                   id="available" {{ old('available', !$car?->available) ? 'checked' : '' }}>
                            <label class="form-check-label" for="available">
                                FUORI USO
                            </label>
                        </div>
                        {!! $errors->first('winter_wheels', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group mb-2 mb20">
                        <label for="doc" class="form-label">{{ __('Data Documento') }}</label>
                        <input type="date" name="date_assignee"
                               class="form-control @error('date_assignee') is-invalid @enderror"
                               value="{{ $car?->carOffices[0]->pivot->date_from ?? date('Y-m-d') }}" id="doc">
                        {!! $errors->first('date_assignee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="tank" class="form-label">{{ __('Serbatoio (L)') }}</label>
                        <input type="number" name="tank" class="form-control @error('tank') is-invalid @enderror"
                               value="{{ old('tank', $car?->tank) }}" id="tank"
                               placeholder="Capacità serbatoio in litri"
                               min="0">
                        {!! $errors->first('tank', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="km" class="form-label">{{ __('Chilometraggio') }}</label>
                        <input type="number" name="km" class="form-control @error('km') is-invalid @enderror"
                               value="{{ old('km', $car?->km) }}" id="km" placeholder="Chilometri percorsi" min="0">
                        {!! $errors->first('km', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20" style="margin-top: 1.3rem">
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
                        <input type="text" name="wheels_type"
                               class="form-control @error('wheels_type') is-invalid @enderror"
                               value="{{ old('wheels_type', $car?->wheels_type) }}" id="wheels_type"
                               placeholder="Tipo pneumatici">
                        {!! $errors->first('wheels_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="warranty" class="form-label">{{ __('Garanzia') }}</label>
                        <input type="text" name="warranty" class="form-control @error('warranty') is-invalid @enderror"
                               value="{{ old('warranty', $car?->warranty) }}" id="warranty"
                               placeholder="Informazioni garanzia">
                        {!! $errors->first('warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="tel_warranty" class="form-label">{{ __('Telefono Assistenza') }}</label>
                        <input type="text" name="tel_warranty"
                               class="form-control @error('tel_warranty') is-invalid @enderror"
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
                        <label for="description" class="form-label">{{ __('Descrizione') }}</label>
                        <input type="text" name="description"
                               class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description', $car?->description) }}" id="description"
                               placeholder="Descrizione veicolo">
                        {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="note" class="form-label">{{ __('Note') }}</label>
                        <textarea name="note" class="form-control @error('note') is-invalid @enderror" id="note"
                                  rows="3"
                                  placeholder="Note aggiuntive">{{ old('note', $car?->note) }}</textarea>
                        {!! $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="row tab-pane fade" id="assigne" role="tabpanel" aria-labelledby="assigne-tab">
            <div class="row pt-3">
                <div class="col-md-6">
                    <div class="input-group justify-content-between border border-info border-2 rounded-2 mb-3">
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <x-dynamic-select
                                    name="car_police_plate_id"
                                    modalClass="modal-xl"
                                    :required="'false'"
                                    :value="old('car_police_plate_id', $car_police_plate_id?->id)"
                                    :options="$polPlates"
                                    :errors="$errors"
                                    endpoint="{{ route('car-plates.storeForm') }}"
                                    label="{{ __('Targa Polizia') }}"
                                    labelKey="name"
                                    idKey="id"
                                    modal-url="{{ route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::POLIZIA]) }}"
                                    modal-title="Nuova targa"
                            />
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_police_plate_force"
                                       type="checkbox" id="car_police_plate_force"
                                       value="1"
                                        {{ old('car_police_plate_force') == '1' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="car_police_plate_force">Forza
                                    riassegnazione</label>
                            </div>
                        </div>
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <x-dynamic-select
                                    name="car_civil_plate_id"
                                    modalClass="modal-xl"
                                    :required="'false'"
                                    :value="old('car_civil_plate_id', $car_civil_plate_id?->id)"
                                    :options="$civPlates"
                                    :errors="$errors"
                                    endpoint="{{ route('car-plates.storeForm') }}"
                                    label="{{ __('Targa Civile') }}"
                                    labelKey="name"
                                    idKey="id"
                                    modal-url="{{ route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::CIVILE]) }}"
                                    modal-title="Nuova targa"
                            />
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_civil_plate_force"
                                       type="checkbox" id="car_civil_plate_force"
                                       value="1"
                                        {{ old('car_civil_plate_force') == '1' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="car_civil_plate_force">Forza riassegnazione</label>
                            </div>
                        </div>
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <x-dynamic-select
                                    name="car_origin_plate_id"
                                    modalClass="modal-xl"
                                    :required="'false'"
                                    :value="old('car_origin_plate_id', $car_origin_plate_id?->id)"
                                    :options="$origPlates"
                                    :errors="$errors"
                                    endpoint="{{ route('car-plates.storeForm') }}"
                                    label="{{ __('Targa Originale') }}"
                                    labelKey="name"
                                    idKey="id"
                                    modal-url="{{ route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::ORIGINALE]) }}"
                                    modal-title="Nuova targa"
                            />
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_origin_plate_force"
                                       type="checkbox" id="car_origin_plate_force"
                                       value="1"
                                        {{ old('car_origin_plate_force') == '1' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="car_origin_plate_force">Forza
                                    riassegnazione</label>
                            </div>
                        </div>
                    </div>
                    <x-dynamic-select
                            name="assignee_id"
                            :required="'false'"
                            :value="old('assignee_id', $car->carOffices[0]?->id ?? null)"
                            :options="$offices"
                            :errors="$errors"
                            endpoint="{{ route('offices.storeForm') }}"
                            label="{{ __('Assegnatario') }}"
                            labelKey="full_name"
                            idKey="id"
                            modal-url="{{ route('offices.getForm') }}"
                            modal-title="Nuovo Assegnatario"
                    />
                </div>
                <div class="col-md-6">
                    <div class="mb-3 text-end">
                        <x-button-modal-form
                                endpoint="{{ route('equipments.storeForm') }}"
                                label="{{ __('Nuovo Equipaggiamento') }}"
                                url="{{ route('equipments.getForm', ['car_id' => $car->id]) }}"
                                modalTitle="Nuovo Equipaggiamento"
                                class="btn-primary"
                                icon="bi-database-fill-add"
                        />
                    </div>

                    <div class="list-group">
                        <div x-data="{
                                items: [],
                                equipments: {{Js::from($equipments) ?? []}},
                                carEquipments: {{ Js::from($car->carEquipment->pluck('id') ?? []) }},
                                carById: {{Js::from($carEquipmentById)}},
                                init() {
                                    this.items = this.equipments.map(equipment => ({
                                        ...equipment,
                                        attivo: this.carEquipments.includes(equipment.id),
                                        note: this.carById[equipment.id]?.pivot.note || ''
                                    }));
                                }
                            }"
                             @button-modal-form.window="items.push($event.detail)"
                        >
                            <template x-for="(item, index) in items" :key="index">
                                    <!-- Elementi -->
                                    <div class="list-group-item d-flex align-items-center">
                                        <input class="form-check-input me-2 flex-shrink-0"
                                               x-model="item.attivo"
                                               type="checkbox" :id="item.id"
                                               :name="'equipments[' + item.id + '][attivo]'"
                                               :value="item.attivo?1:0"
                                        >
                                        <label :for="'label_' + item.id" class="flex-grow-1 mb-0 me-3" x-text="item.name"></label>
                                        <input type="text" class="form-control w-50"
                                               :id="'label_' + item.id"
                                               x-model="item.note"
                                               :name="'equipments[' + item.id + '][note]'"
                                               placeholder="Inserire dati..."
                                               :disabled="!item.attivo"
                                        >
                                    </div>


                            </template>
                        </div>


                        {{--                        @foreach($equipments as $equipment)--}}
                        {{--                            <!-- Elemento 1 -->--}}
                        {{--                            <div class="list-group-item d-flex align-items-center">--}}
                        {{--                                <input class="form-check-input me-2 flex-shrink-0"--}}
                        {{--                                       type="checkbox" id="{{$equipment->id}}"--}}
                        {{--                                       name="equipments[{{$equipment->id}}][attivo]" value="1"--}}
                        {{--                                        @checked( in_array($equipment->id, old('equipments[$equipment->id][attivo]', $car->carEquipment->pluck('id')->toArray())) )--}}
                        {{--                                >--}}
                        {{--                                <label for="item1" class="flex-grow-1 mb-0 me-3">{{$equipment->name}}</label>--}}
                        {{--                                <input type="text" class="form-control w-50"--}}
                        {{--                                       value="{{old('equipments[$equipment->id][note]', $carEquipmentById[$equipment->id]?->pivot->note ?? '')}}"--}}
                        {{--                                       name="equipments[{{$equipment->id}}][note]"--}}
                        {{--                                       placeholder="Inserire dati..." disabled--}}
                        {{--                                >--}}
                        {{--                            </div>--}}
                        {{--                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($button)
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
@endif

@push('scripts')
    <script>
        document.querySelectorAll('.list-group-item input[type="checkbox"]').forEach(checkbox => {
            const textInput = checkbox.closest('.list-group-item').querySelector('input[type="text"]');
            textInput.disabled = !checkbox.checked;
            checkbox.addEventListener('change', () => {
                textInput.disabled = !checkbox.checked;
                // if (!checkbox.checked) textInput.value = '';
            });
        });

    </script>
@endpush
