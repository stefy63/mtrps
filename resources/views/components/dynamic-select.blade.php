<div
        x-data='dynamicSelect({
        required: {{ $required ?? false }},
        value: "{{ $value }}",
        errors: {{ $errors }},
        options: @json($options),
        endpoint: "{{ $endpoint }}",
        idKey: "{{ $idKey ?? 'id' }}",
        labelKey: "{{ $labelKey ?? "name" }}",
        label: "{{ $label ?? "Seleziona" }}",
        modalUrl: "{{ $modalUrl }}",
        modalTitle: "{{ $modalTitle ?? "Nuovo elemento" }}",
        modalClass: "{{ $modalClass ?? "" }}",
    })'
>


    <!-- Campo di selezione dinamica con ricerca -->
    <div class="form-group mb-2 mb20">
        <label for="car_type_id" x-text="label"></label>
        <div class="position-relative">
            <div class="input-group">
                <!-- Input ricerca -->
                <input type="text"
                       :required="required"
                       aria-describedby="button-add-type"
                       :class="{'is-invalid': isInvalid}"
                       class="form-control"
                       placeholder="Seleziona..."
                       x-model="search"
                       @focus="open = true, search = '', option_id = null"
                       @click.away="open = false">
                <button class="btn btn-outline-secondary"
                        @click="openParentModal"
                        type="button"
                        id="button-add-type">+
                </button>
                <template x-if="isInvalid">
                    <div class="invalid-feedback" role="alert"><strong>{{$errors->first('car_type_id')}}</strong></div>
                </template>
            </div>

            <!-- Dropdown -->
            <ul class="list-group position-absolute w-100 mt-1 z-10"
                x-show="open"
                style="max-height: 200px; overflow-y: auto; z-index: 10">
                <template x-for="option in filteredOptions" :key="option[idKey]">
                    <li class="list-group-item list-group-item-action"
                        @click="option_id = option.id; search = option.name; open = false"
                        x-text="option.name">
                    </li>
                </template>
            </ul>
        </div>
        <input type="hidden" name="{{ $name }}" :value="option_id">
    </div>


</div>
