@props([
    'name' => 'datetime',
    'value' => '',
    'dateFormat' => 'Y-m-d H:i',
    'altFormat' => 'd/m/Y H:i',
    'enableSeconds' => false,
])

<div
        x-data="datetimePicker({
        value: '{{ $value }}',
        dateFormat: '{{ $dateFormat }}',
        altFormat: '{{ $altFormat }}',
        enableSeconds: {{ $enableSeconds ? 'true' : 'false' }},
    })"
        class="relative inline-flex items-center"
>
    <!-- Hidden field per il form -->
    <input type="hidden" name="{{ $name }}" x-bind:value="value">
    <div class="input-group">
        {{--        📅--}}
        <!-- Icona calendario -->
        <span class="input-group-text">
            <i class="bi bi-calendar2-date text-danger"></i>
        </span>
        <!-- Input visibile -->
        <input
                x-ref="input"
                x-model="value"
                type="text"
                placeholder="Seleziona data e ora"
                aria-label="Seleziona data e ora"
                autocomplete="off"
                class="form-control border px-2 py-1 w-48 pr-10 pl-8"
        >
        <button
                type="button"
                class="btn btn-warning"
                @click="clear()"
        >
            <i class="bi bi-x-circle"></i>
        </button>
    </div>
</div>
