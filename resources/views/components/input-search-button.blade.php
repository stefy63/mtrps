<div x-data='searchBox({
        action: "{{$action ?? ''}}",
        query: "{{$search ?? ''}}"
})'
>
    <form x-ref="searchForm" class="row" :action="action" method="GET">
        <div class="input-group">
            <button @click="submitForm" type="button" class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
            <input x-ref="searchInput" name="search" type="text" class="form-control" placeholder="Cerca..."
                   @input="handleInput()" :value="query" x-model="query" autofocus>
            <button
                    type="button"
                    class="btn btn-warning"
                    x-show="query.length > 0"
                    @click="clearAndSubmit()"
            >
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
        <div>
            <template x-if="loading">
                <p class="text-gray-500 mt-2">🔍 Ricerca in corso...</p>
            </template>

        </div>
    </form>
    <script>
        function searchBox(config) {
            return {
                action: config.action,
                query: config.query,
                timeout: null,
                loading: false,
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