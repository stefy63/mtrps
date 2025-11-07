<div x-data='searchBox({
        action: "{{$action ?? ''}}",
        search: "{{$search ?? ''}}",
        name: "{{$name ?? 'attivo'}}",
        chk: "{{$check ?? false}}",
        label: "{{$label ?? null}}",
        enableCheck: "{{$label ?? false}}",
})'
>
    <form x-ref="searchForm" class="d-flex justify-content-between" :action="action" method="GET">
        <div class="col-4">
            <div class="input-group">
                <button @click="submitForm" type="button" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
                <input x-ref="searchInput" name="search" type="text" class="form-control" placeholder="Cerca..."
                       @input="handleInput()" :value="query" x-model="query" autofocus>
                <button
                        type="button"
                        class="btn btn-warning"
{{--                        x-show="query.length > 0"--}}
                        @click="clearAndSubmit()"
                >
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>

        </div>
        <div class="col-1">
            <template x-if="enableCheck">
                <div class="input-group">
                    <div class="form-check form-switch">
                        <input @change="submitForm"
                               value="true"
                               class="form-check-input"
                               type="checkbox"
                               id="this-check"
                               :name="name"
                               x-model.boolean="check">
                        <label class="form-check-label" for="this-check" x-text="label"></label>
                    </div>
                </div>
            </template>
        </div>
    </form>
    <div>
        <template x-if="loading">
            <p class="text-gray-500 mt-2">🔍 Ricerca in corso...</p>
        </template>

    </div>
    <script>
        function searchBox(config) {
            return {
                action: config.action || window.location.pathname,
                check: config.chk === 'true' || config.chk === true,
                name: config.name,
                label: config.label,
                loading: false,
                search: config.search,
                enableCheck: config.enableCheck,
                timeout: null,
                init() {
                    const params = new URLSearchParams(window.location.search);
                    const paramValue = params.get(this.name);
                    const searchValue = params.get('search');
                    this.check = paramValue === 'true' || paramValue === '1';
                    this.query = searchValue;
                },
                handleInput() {
                    clearTimeout(this.timeout);
                    this.loading = true
                    this.timeout = setTimeout(() => {
                        this.submitForm();
                    }, 1000);
                },
                submitForm() {
                    this.$refs.searchForm.submit();
                    setTimeout(() => {
                        this.loading = false
                    }, 1000)
                },
                clearAndSubmit() {
                    this.$refs.searchInput.value = ''
                    this.loading = true
                    this.query = '';
                    this.submitForm();
                }
            }
        }
    </script>
</div>
<style>
    .form-control:focus {
        box-shadow: none !important;
    }
</style>