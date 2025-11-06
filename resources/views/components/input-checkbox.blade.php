<div x-data='checkBox({
        name: "{{$name ?? 'attivo'}}",
        action: "{{$action ?? ''}}",
        value: "{{$value ?? false}}",
        label: "{{$label ?? 'Attivo'}}",
})'
>
    <div class="input-group">
        <div class="form-check form-switch">
            <input @change="submitForm"
                   value="true"
                   class="form-check-input"
                   type="checkbox"
                   id="this-check"
                   :name="name"
                   x-model.boolean="query">
            <label class="form-check-label" for="this-check" x-text="label"></label>
        </div>
    </div>
    <div>
        <template x-if="loading">
            <p class="text-gray-500 mt-2">🔍 Ricerca in corso...</p>
        </template>

    </div>
    <script>
        function checkBox(config) {
            return {
                action: config.action || window.location.pathname,
                query: config.value === 'true' || config.value === true,
                name: config.name,
                label: config.label,
                loading: false,
                init() {
                    const params = new URLSearchParams(window.location.search);
                    const paramValue = params.get(this.name);
                    this.query = paramValue === 'true' || paramValue === '1';
                },
                submitForm() {
                    this.loading = true
                    // this.$refs.searchForm.submit();

                    const url = new URL(this.action, window.location.origin);
                    const params = new URLSearchParams(window.location.search);

                    if (this.query) {
                        params.set(this.name, 'true');
                    } else {
                        params.delete(this.name);
                    }
                    const newUrl = `${url.pathname}${params.toString() ? '?' + params.toString() : ''}`;
                    window.location.href = newUrl;
                },
            }
        }
    </script>
</div>

<style>
    .form-check-input:focus {
        box-shadow: none !important;
    }
</style>

