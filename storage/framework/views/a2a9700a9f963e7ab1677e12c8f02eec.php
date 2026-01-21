<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => 'datetime-' . uniqid(),
    'name' => 'datetime',
    'label' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
    'type' => 'datetime-local',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id' => 'datetime-' . uniqid(),
    'name' => 'datetime',
    'label' => null,
    'value' => null,
    'required' => false,
    'disabled' => false,
    'type' => 'datetime-local',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div
        x-data="{
        value: <?php echo \Illuminate\Support\Js::from($value)->toHtml() ?>,
    }"
>
<?php if($label): ?>
    <label for="<?php echo e($id); ?>" class="form-label">
        <?php echo e($label); ?>

        <?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?>
    </label>
<?php endif; ?>
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-calendar2-date text-danger"></i>
        </span>
        <input 
            type="<?php echo e($type); ?>"
            id="<?php echo e($id); ?>"
            name="<?php echo e($name); ?>"
            class="form-control"
            placeholder="gg/mm/aaaa hh:mm"
            x-model="value"
            x-bind:value="value"
            @change="if (!value) value = null"
            <?php if($required): ?> required <?php endif; ?>
            <?php if($disabled): ?> disabled <?php endif; ?>
        >
        <button
                type="button"
                class="btn btn-warning"
                @click="value = null"
        >
            <i class="bi bi-x-circle"></i>
        </button>
    </div>
</div>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/datetime-picker.blade.php ENDPATH**/ ?>