<div x-data="{ 
        open: false, 
        selected: {{ json_encode($selected ?? []) }},
        toggleAll(event) {
            if (event.target.checked) {
                // seleziona tutti
                this.selected = @json(array_keys($options));
            } else {
                // deseleziona tutto
                this.selected = [];
            }
        },
        isAllSelected() {
            return this.selected.length === {{ count($options) }};
        }
    }" 
    x-init="console.log(selected)"
    class="position-relative w-100">

    <!-- Finta select -->
    <div class="form-control" @click="open = !open" style="cursor:pointer">
        <template x-if="selected.length === 0">
            <span class="text-muted">Seleziona...</span>
        </template>

        <template x-if="selected.length > 0">
            <span x-text="selected.join(', ')"></span>
        </template>
    </div>

    <!-- Dropdown -->
    <div class="border rounded bg-white shadow p-2 position-absolute mt-1 w-100"
         x-show="open" @click.outside="open = false" style="z-index:999">

        <!-- Seleziona tutti -->
        <label class="d-flex align-items-center gap-2 py-1 border-bottom mb-2 pb-2">
            <input type="checkbox"
                   @change="toggleAll($event)"
                   :checked="isAllSelected()">
            <strong>Seleziona tutti</strong>
        </label>

        <!-- Tutte le opzioni -->
        @foreach($options as $value => $label)
            <label class="d-flex align-items-center gap-2 py-1">
                <input type="checkbox"
                       value="{{ $value }}"
                       @change="
                           if ($event.target.checked) {
                               selected.push('{{ $value }}')
                           } else {
                               selected = selected.filter(v => v !== '{{ $value }}')
                           }
                       "
                       :checked="selected.includes('{{ $value }}')"
                >
                {{ $label }}
            </label>
        @endforeach
    </div>

    <!-- Hidden inputs -->
    <template x-for="val in selected" :key="val">
        <input type="hidden" name="{{ $name }}[]" :value="val">
    </template>

</div>
