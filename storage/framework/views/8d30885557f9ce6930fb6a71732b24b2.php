<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'required' => false,
    'value' => null,
    'errors' => null,
    'options' => [],
    'endpoint' => null,
    'idKey' => 'id',
    'labelKey' => 'name',
    'label' => 'Seleziona',
    'modalUrl' => null,
    'modalTitle' => 'Nuovo elemento',
    'modalClass' => '',
    'class' => '',
    'disabled' => false,
    'onChange' => null,
    'onFilter' => null,
    'event' => 'dynamic-select',
    'name' => null,
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
    'required' => false,
    'value' => null,
    'errors' => null,
    'options' => [],
    'endpoint' => null,
    'idKey' => 'id',
    'labelKey' => 'name',
    'label' => 'Seleziona',
    'modalUrl' => null,
    'modalTitle' => 'Nuovo elemento',
    'modalClass' => '',
    'class' => '',
    'disabled' => false,
    'onChange' => null,
    'onFilter' => null,
    'event' => 'dynamic-select',
    'name' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>


<div
        x-data='dynamicSelect({
        required: "<?php echo e($required); ?>",
        value: "<?php echo e($value); ?>",
        errors: <?php echo e($errors); ?>,
        options: <?php echo json_encode($options, 15, 512) ?>,
        endpoint: "<?php echo e($endpoint); ?>",
        idKey: "<?php echo e($idKey); ?>",
        labelKey: "<?php echo e($labelKey); ?>",
        label: "<?php echo e($label); ?>",
        modalUrl: "<?php echo e($modalUrl); ?>",
        modalTitle: "<?php echo e($modalTitle); ?>",
        modalClass: "<?php echo e($modalClass); ?>",
        class: "<?php echo e($class); ?>",  
        disabled: "<?php echo e($disabled); ?>",
        callbackChange: "<?php echo e($onChange); ?>",
        callbackFilter: "<?php echo e($onFilter); ?>",
        eventName: "<?php echo e($event); ?>:changed"
})'
>

    <!-- Campo di selezione dinamica con ricerca -->
    <template x-if="options.length > 0">
        <div :class="getClass()">
            <label class="form-label <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" for="<?php echo e($name); ?>">
                <span x-text="label"></span>
                <?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?>
            </label>
            <div class="position-relative">
                <div class="input-group">
                    <!-- Input ricerca -->
                    <input type="text"
                        :disabled="disabled"
                        id="<?php echo e($name); ?>"
                        :required="required"
                        aria-describedby="button-add-type"
                        :class="{'is-invalid': isInvalid}"
                        class="form-floating"
                        placeholder="Seleziona..."
                        x-model="search"
                        @focus="open = true, search = '', option_id = null"
                        @click.away="oldSearch">
                    <button class="btn btn-outline-secondary"
                            @click="openParentModal"
                            type="button"
                            id="button-add-type">+
                    </button>
                    <template x-if="isInvalid">
                        <div class="invalid-feedback" role="alert"><strong><?php echo e($errors->first($name)); ?></strong></div>
                    </template>
                </div>

                <!-- Dropdown -->
                <ul class="list-group position-absolute w-100 mt-1 z-10"
                    x-show="open"
                    style="max-height: 200px; overflow-y: auto; z-index: 10;">
                    <template x-if="search === ''">
                        <li class="list-group-item list-group-item-action bg-info-subtle"
                            @click="clearSearch(); $refs.hidden.dispatchEvent(new Event('change'));">
                            Nessuna
                        </li>
                    </template>
                    <template x-for="option in filteredOptions" :key="option[idKey]">
                        <li class="list-group-item list-group-item-action bg-info-subtle"
                            @click="option_id = option.id; search = option[labelKey]; open = false; $refs.hidden.dispatchEvent(new Event('change'));"
                            x-text="option[labelKey]">
                        </li>
                    </template>
                </ul>
            </div>
            <input x-ref="hidden"
    
            type="hidden"
            name="<?php echo e($name); ?>" x-model="option_id">
        </div>
    </template>
</div>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/dynamic-select.blade.php ENDPATH**/ ?>