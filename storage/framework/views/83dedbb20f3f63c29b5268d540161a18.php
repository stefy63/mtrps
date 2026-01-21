<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['id' => 'offcanvasExample', 'label' => 'Offcanvas']));

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

foreach (array_filter((['id' => 'offcanvasExample', 'label' => 'Offcanvas']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="<?php echo e($id); ?>" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php echo e($label); ?></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="dropdown mt-3">
                <ul class="nav flex-column">
                    <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('home'),'active' => request()->routeIs('home')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('home')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('home'))]); ?>
                        <?php echo e(__('Home')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('cars.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('cars.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                        <?php echo e(__('Vetture')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('movements.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('movements.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                        <?php echo e(__('Movimenti')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('maintenances.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('maintenances.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                        <?php echo e(__('Manutenzioni')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('cigs.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('cigs.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                        <?php echo e(__('CIG')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-expanded="false">Anagrafiche</a>
                        <ul class="dropdown-menu ms-5">
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-plates.index'),'active' => request()->routeIs('car-plates.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-plates.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('car-plates.index'))]); ?>
                                <?php echo e(__('Targhe Vetture')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-owners.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-owners.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Proprietari')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('offices.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('offices.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Uffici')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-brands.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-brands.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Marca')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-types.index'),'active' => request()->routeIs('car-types.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-types.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('car-types.index'))]); ?>
                                <?php echo e(__('Tipo Vettura')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-powers.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-powers.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Alimentazioni')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('equipments.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('equipments.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Dotazioni')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('maintenance-garages.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('maintenance-garages.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Officine')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('maintenance-types.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('maintenance-types.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Tipi di intervento')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('employment-code.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('employment-code.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Codici d\'impiego')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-typology.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-typology.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Tipologie Vetture')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                        </ul>
                    </li>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-expanded="false">Utilità</a>
                        <ul class="dropdown-menu ms-5">
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('users.index'),'active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('users.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                                <?php echo e(__('Utenti')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('car-imports.index'),'active' => request()->routeIs('imports/cars')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('car-imports.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('imports/cars'))]); ?>
                                <?php echo e(__('Import Vetture')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('km-imports.index'),'active' => request()->routeIs('imports/km')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('km-imports.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('imports/km'))]); ?>
                                <?php echo e(__('Import Kilometri')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal57e9835165302abe8142ac4cac477c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57e9835165302abe8142ac4cac477c46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.menu-link','data' => ['href' => route('auto-update'),'active' => request()->routeIs('auto-update')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menu-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('auto-update')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('auto-update'))]); ?>
                                <?php echo e(__('Aggiornamento Automatico')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $attributes = $__attributesOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__attributesOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57e9835165302abe8142ac4cac477c46)): ?>
<?php $component = $__componentOriginal57e9835165302abe8142ac4cac477c46; ?>
<?php unset($__componentOriginal57e9835165302abe8142ac4cac477c46); ?>
<?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/components/off-canvas-menu.blade.php ENDPATH**/ ?>