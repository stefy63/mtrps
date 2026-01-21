<div x-data="{ 
        open: false, 
        selected: <?php echo e(json_encode($selected ?? [])); ?>,
        toggleAll(event) {
            if (event.target.checked) {
                // seleziona tutti
                this.selected = <?php echo json_encode(array_keys($options), 15, 512) ?>;
            } else {
                // deseleziona tutto
                this.selected = [];
            }
        },
        isAllSelected() {
            return this.selected.length === <?php echo e(count($options)); ?>;
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
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="d-flex align-items-center gap-2 py-1">
                <input type="checkbox"
                       value="<?php echo e($value); ?>"
                       @change="
                           if ($event.target.checked) {
                               selected.push('<?php echo e($value); ?>')
                           } else {
                               selected = selected.filter(v => v !== '<?php echo e($value); ?>')
                           }
                       "
                       :checked="selected.includes('<?php echo e($value); ?>')"
                >
                <?php echo e($label); ?>

            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Hidden inputs -->
    <template x-for="val in selected" :key="val">
        <input type="hidden" name="<?php echo e($name); ?>[]" :value="val">
    </template>

</div>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/select-multi-checkbox.blade.php ENDPATH**/ ?>