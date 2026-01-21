<div
        x-data='buttonModalHandler({
            endpoint: "<?php echo e($endpoint); ?>",
            label: "<?php echo e($label ?? null); ?>",
            url: "<?php echo e(str_replace('amp;', '', $url)); ?>",
            modalTitle: "<?php echo e($modalTitle ?? "Nuovo elemento"); ?>",
            modalClass: "<?php echo e($modalClass ?? ""); ?>",
            class: "<?php echo e($class ?? ""); ?>",
            icon: "<?php echo e($icon ?? null); ?>",
            event: "<?php echo e($event ?? 'button-modal-form'); ?>"
        })'
>
    <div>
        <div class="position-relative">
            <button class="btn <?php echo e($class); ?>"
                    @click="openModal"
                    type="button"
            >
                <template x-if="icon">
                    <i class="bi <?php echo e($icon); ?>"></i>
                </template>
                <template x-if="label">
                    <span x-text="label"></span>
                </template>

            </button>
        </div>
    </div>
</div><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/button-modal-form.blade.php ENDPATH**/ ?>