<div x-data='searchBox({
        action: "{{$action ?? ''}}",
        query: "{{$search ?? ''}}"
})'
>
    <form x-ref="searchForm" class="row" :action="action" method="GET">
        <div class="input-group col-md-6">
            <button @click="submitForm" type="button" class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
            <input x-ref="searchInput" name="search" type="text" class="form-control" placeholder="Cerca..." :value="query" x-model="query">
            <button
                    type="button"
                    class="btn btn-outline-warning"
                    x-show="query.length > 0"
                    @click="clearAndSubmit"
            >
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
    </form>
    <script>
        function searchBox(config) {
            return {
                action: config.action,
                query: config.query,
                timeout: null,
                init() {
                    this.$watch('query', () => {
                        clearTimeout(this.timeout);
                        this.timeout = setTimeout(() => {
                            this.submitForm();
                        }, 500);
                    });
                },
                submitForm() {
                    this.$refs.searchForm.submit();
                },
                clearAndSubmit() {
                    this.$refs.searchInput.value = ''
                    this.query = '';
                    this.submitForm();
                }
            }
        }
    </script>
</div>

