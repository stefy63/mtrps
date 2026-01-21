@props([
    'required' => false,
    'value' => null,
    'errors' => null,
    'options' => [],
    'endpoint' => null,
    'idKey' => 'id',
    'labelKey' => 'name',
    'label' => 'Seleziona',
    'modalUrl' => null,
    'modalTitle' => 'Nuovo elemento',
    'modalClass' => '',
    'class' => '',
    'disabled' => false,
    'onChange' => null,
    'onFilter' => null,
    'event' => 'dynamic-select',
    'name' => null,
])


<div
        x-data='dynamicSelect({
        required: "{{ $required }}",
        value: "{{ $value }}",
        errors: {{ $errors }},
        options: @json($options),
        endpoint: "{{ $endpoint }}",
        idKey: "{{ $idKey }}",
        labelKey: "{{ $labelKey }}",
        label: "{{ $label }}",
        modalUrl: "{{ $modalUrl }}",
        modalTitle: "{{ $modalTitle }}",
        modalClass: "{{ $modalClass }}",
        class: "{{ $class }}",  
        disabled: "{{ $disabled }}",
        callbackChange: "{{ $onChange }}",
        callbackFilter: "{{ $onFilter }}",
        eventName: "{{ $event }}:changed"
})'
>

    <!-- Campo di selezione dinamica con ricerca -->
    <template x-if="options.length > 0">
        <div :class="getClass()">
            <label class="form-label @error($name) is-invalid @enderror" for="{{ $name }}">
                <span x-text="label"></span>
                @if ($required) <span class="text-danger">*</span> @endif
            </label>
            <div class="position-relative">
                <div class="input-group">
                    <!-- Input ricerca -->
                    <input type="text"
                        :disabled="disabled"
                        id="{{ $name }}"
                        :required="required"
                        aria-describedby="button-add-type"
                        :class="{'is-invalid': isInvalid}"
                        class="form-floating"
                        placeholder="Seleziona..."
                        x-model="search"
                        @focus="open = true, search = '', option_id = null"
                        @click.away="oldSearch">
                    <button class="btn btn-outline-secondary"
                            @click="openParentModal"
                            type="button"
                            id="button-add-type">+
                    </button>
                    <template x-if="isInvalid">
                        <div class="invalid-feedback" role="alert"><strong>{{$errors->first($name)}}</strong></div>
                    </template>
                </div>

                <!-- Dropdown -->
                <ul class="list-group position-absolute w-100 mt-1 z-10"
                    x-show="open"
                    style="max-height: 200px; overflow-y: auto; z-index: 10;">
                    <template x-if="search === ''">
                        <li class="list-group-item list-group-item-action bg-info-subtle"
                            @click="clearSearch(); $refs.hidden.dispatchEvent(new Event('change'));">
                            Nessuna
                        </li>
                    </template>
                    <template x-for="option in filteredOptions" :key="option[idKey]">
                        <li class="list-group-item list-group-item-action bg-info-subtle"
                            @click="option_id = option.id; search = option[labelKey]; open = false; $refs.hidden.dispatchEvent(new Event('change'));"
                            x-text="option[labelKey]">
                        </li>
                    </template>
                </ul>
            </div>
            <input x-ref="hidden"
    {{--           x-on:change="$dispatch('car-type:changed', { detail: option_id})" --}}
            type="hidden"
            name="{{ $name }}" x-model="option_id">
        </div>
    </template>
</div>
