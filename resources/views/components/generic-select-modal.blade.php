<!-- Modale -->
<div class="modal fade" id="dinamicModal" tabindex="-1" x-data="modalHandler()" aria-hidden="true">
    <div class="modal-dialog" :class="modalClass">
        <div class="modal-content">
            <form x-ref="innerForm">
                <div class="modal-header">
                    <h5 class="modal-title" x-text="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            @click="openModal = false"></button>
                </div>

                <div class="modal-body">
                    <template x-if="loading">
                        <p>Caricamento subform...</p>
                    </template>
                    @csrf
                    <div x-html="modalContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" @click="saveData">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div>
