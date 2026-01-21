<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item' => '', 'itemRoute' => '', 'label' => '']));

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

foreach (array_filter((['item' => '', 'itemRoute' => '', 'label' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $itemRoute = $itemRoute ?: mb_strtolower(class_basename($item)).'s';
    $id = $item->id;
?>
<div>
    <a data-bs-toggle="tooltip" title="Visualizza dati <?php echo e($label); ?>" class="ms-2"
       href="<?php echo e(route($itemRoute.'.show', $item->id)); ?>"><i
                class="bi bi-search"></i></a>
    <a data-bs-toggle="tooltip" title="Modifica  <?php echo e($label); ?>" class="ms-2"
       href="<?php echo e(route($itemRoute.'.edit', $item->id)); ?>"><i
                class="bi bi-pencil-square text-success"></i></a>
    <a data-bs-toggle="tooltip" title="Cancella  <?php echo e($label); ?>" class="ms-2" data-confirm-delete="true"
       href="<?php echo e(route($itemRoute.'.destroy', $item->id)); ?>"><i
                class="bi bi-trash text-danger"></i></a>
</div><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/action-table-button.blade.php ENDPATH**/ ?>