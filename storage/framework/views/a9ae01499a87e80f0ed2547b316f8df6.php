<?php $__env->startSection('template_title'); ?>
    Cars
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <?php echo e(__('Cars')); ?>

                            </span>

                            <div class="float-right">
                                <a href="<?php echo e(route('cars.create')); ?>" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    <?php echo e(__('Nuovo')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <?php if (isset($component)) { $__componentOriginald388fb50d785f8c96a7087674ab9760e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald388fb50d785f8c96a7087674ab9760e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-search-button','data' => ['action' => ''.e(route('cars.index')).'','search' => ''.e(old('search', $search)).'','name' => 'unavailable','label' => 'Fuori Uso','check' => ''.e(old('unavailable', $unavailable)).'','enableCheck' => ''.e(true).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-search-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(route('cars.index')).'','search' => ''.e(old('search', $search)).'','name' => 'unavailable','label' => 'Fuori Uso','check' => ''.e(old('unavailable', $unavailable)).'','enableCheck' => ''.e(true).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald388fb50d785f8c96a7087674ab9760e)): ?>
<?php $attributes = $__attributesOriginald388fb50d785f8c96a7087674ab9760e; ?>
<?php unset($__attributesOriginald388fb50d785f8c96a7087674ab9760e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald388fb50d785f8c96a7087674ab9760e)): ?>
<?php $component = $__componentOriginald388fb50d785f8c96a7087674ab9760e; ?>
<?php unset($__componentOriginald388fb50d785f8c96a7087674ab9760e); ?>
<?php endif; ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>Targa</th>
                                        <th>Modello</th>
                                        <th>Tipologia</th>
                                        <th>Colore</th>
                                        <th>Ufficio Assegnatario</th>
                                        <th><abbr title="Codice Impiego">C. I.</abbr></th>
                                        <th>Proprietario</th>
                                        <th>Telaio</th>
                                        <th>Km</th>
                                        <th>Alimentazione</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?php if(!$car->available): ?> text-decoration-line-through <?php endif; ?>">
                                            
                                            <td>
                                                <ul class="list-unstyled">
                                                    <?php $__currentLoopData = $car->carPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="
                                                    <?php switch($plate->type):
                                                        case ('POLIZIA'): ?>
                                                            text-primary
                                                            <?php break; ?>
                                                        <?php case ('CIVILE'): ?>
                                                            text-info
                                                            <?php break; ?>
                                                        <?php case ('ORIGINALE'): ?>
                                                            text-danger
                                                            <?php break; ?>
                                                        <?php default: ?>
                                                            text-muted
                                                    <?php endswitch; ?>
                                                    " style="font-size: 10px"><?php echo e($plate->name); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <?php if($car->maintenances->count() > 0): ?>
                                                    <i class="bi bi-gear-fill text-danger"></i>
                                                <?php endif; ?>
                                                <?php if($car->movements->count() > 0): ?>
                                                    <i class="bi bi-car-front text-warning"></i>
                                                <?php endif; ?>
                                                <?php echo e($car->full_name ?? 'N/A'); ?>

                                            </td>
                                            <td >(<?php echo e($car->carTypology->name ?? 'N/A'); ?>)</td>
                                            <td><?php echo e($car->color ?? 'N/A'); ?></td>
                                            <td><?php echo e($car->carOffices->first()?->full_name ?? 'N/A'); ?></td>
                                            <td><abbr title="<?php echo e($car->carEmployment->extended ?? 'N/A'); ?>"><?php echo e($car->carEmployment->code ?? 'N/A'); ?></abbr></td>
                                            <td><?php echo e($car->carOwner->name ?? 'N/A'); ?></td>
                                            <td class="small"><?php echo e($car->chassis ?? 'N/A'); ?></td>
                                            <td><?php echo e(number_format($car->km ?? 0)); ?> km</td>
                                            <td><?php echo e($car->carPower?->name ?? 'N/A'); ?></td>

                                            <td class="text-end">
                                                <?php if($car->available): ?>
                                                    <?php if (isset($component)) { $__componentOriginalfbce4f648cc24125dc0d91a9692160ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-table-button','data' => ['item' => $car,'label' => 'Vettura']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-table-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($car),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Vettura')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbce4f648cc24125dc0d91a9692160ef)): ?>
<?php $attributes = $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef; ?>
<?php unset($__attributesOriginalfbce4f648cc24125dc0d91a9692160ef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbce4f648cc24125dc0d91a9692160ef)): ?>
<?php $component = $__componentOriginalfbce4f648cc24125dc0d91a9692160ef; ?>
<?php unset($__componentOriginalfbce4f648cc24125dc0d91a9692160ef); ?>
<?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php echo $cars->withQueryString()->links(); ?>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/car/index.blade.php ENDPATH**/ ?>