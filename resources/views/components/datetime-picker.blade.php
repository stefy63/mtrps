@props([
    'id' => 'datetime-' . uniqid(),
    'name' => 'datetime',
    'label' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
])

<div
        x-data="{
        value: @js($value),
    }"
>
@if ($label)
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
@endif
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-calendar2-date text-danger"></i>
        </span>
        <input 
            type="datetime-local"
            id="{{ $id }}"
            name="{{ $name }}"
            class="form-control"
            placeholder="gg/mm/aaaa hh:mm"
            x-model="value"
            x-bind:value="value"
            @change="if (!value) value = null"
            @if($required) required @endif
            @if($disabled) disabled @endif
        >
        <button
                type="button"
                class="btn btn-warning"
                @click="value = null"
        >
            <i class="bi bi-x-circle"></i>
        </button>
    </div>
</div>
