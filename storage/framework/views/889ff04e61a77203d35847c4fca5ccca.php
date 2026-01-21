<!-- Modale -->
<div class="modal fade" id="dinamicModal" tabindex="-1" x-data="modalHandler()" aria-hidden="true">
    <div class="modal-dialog" :class="modalClass">
        <div class="modal-content">
            <form x-ref="innerForm" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" x-text="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            @click="openModal = false"></button>
                </div>

                <div class="modal-body">
                    <template x-if="loading">
                        <p>Caricamento subform...</p>
                    </template>
                    <?php echo csrf_field(); ?>
                    <div x-html="modalContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" @click="saveData">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/generic-select-modal.blade.php ENDPATH**/ ?>