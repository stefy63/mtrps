<?php $__env->startSection('content'); ?>
    <div class="container-fluid" style="font-size: 20px;">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="card_title">
                        <?php echo e(__('Dashboard')); ?>

                    </span>

                    <div class="float-right" id="spinner">
                        <div class="spinner-grow text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3 w-100">
                        <?php if (isset($component)) { $__componentOriginald388fb50d785f8c96a7087674ab9760e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald388fb50d785f8c96a7087674ab9760e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-search-button','data' => ['action' => ''.e(Auth::check() ? route('home') : route('dashboard')).'','search' => ''.e(old('search', $search)).'','name' => 'search','label' => 'Cerca','check' => ''.e(old('search', $search)).'','enableCheck' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-search-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(Auth::check() ? route('home') : route('dashboard')).'','search' => ''.e(old('search', $search)).'','name' => 'search','label' => 'Cerca','check' => ''.e(old('search', $search)).'','enableCheck' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                            <div class="d-flex w-50 justify-content-end mx-2">
                                <?php if (isset($component)) { $__componentOriginal3b7c6683b6f88e0304157dd1d8e35721 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b7c6683b6f88e0304157dd1d8e35721 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multi-checkbox','data' => ['options' => $typology,'name' => 'carTypology','selected' => $carTypology]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multi-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($typology),'name' => 'carTypology','selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carTypology)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b7c6683b6f88e0304157dd1d8e35721)): ?>
<?php $attributes = $__attributesOriginal3b7c6683b6f88e0304157dd1d8e35721; ?>
<?php unset($__attributesOriginal3b7c6683b6f88e0304157dd1d8e35721); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b7c6683b6f88e0304157dd1d8e35721)): ?>
<?php $component = $__componentOriginal3b7c6683b6f88e0304157dd1d8e35721; ?>
<?php unset($__componentOriginal3b7c6683b6f88e0304157dd1d8e35721); ?>
<?php endif; ?>

                            </div>
                            <div class="d-flex gap-2 align-items-center w-50">
                                <?php if (isset($component)) { $__componentOriginale69e472b1fdf480b1092c0d115ca0b31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datetime-picker','data' => ['value' => ''.e(old('date', $date)).'','name' => 'date']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datetime-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e(old('date', $date)).'','name' => 'date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $attributes = $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $component = $__componentOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
                                <button type="submit" class="btn btn-outline p-0"><i class="bi bi-search"></i></button>
                            </div>
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
                </div>
                <table class="w-100 table table-striped table-bordered table-hover" >
                    <thead>
                        <tr class="">
                            <th class="text-bg-info fw-bold">
                                ENTE
                            </th>
                            <th class="text-bg-info fw-bold">TOTALI</th>
                            <th class="text-bg-info fw-bold">IN RIPARAZIONE</th>
                            <th class="text-bg-info fw-bold">IN PRESTITO</th>
                            <th class="text-bg-info fw-bold">PRESTATE</th>
                            <th class="text-bg-info fw-bold">DISPONIBILI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="">
                                <td class="fw-bold text-truncate">
                                    <?php echo e($d->ente); ?>

                                </td>
                                <td class="fw-bold"><?php echo e($d->active_cars_count); ?></td>
                                <td class="fw-bold text-muted"><?php echo e($d->active_maintenance_count); ?></td>
                                <td class="fw-bold text-info"><?php echo e($d->movements_from_count); ?></td>
                                <td class="fw-bold text-danger"><?php echo e($d->movements_to_count); ?></td>
                                <td class="fw-bold text-success">
                                    <?php echo e(($d->active_cars_count + $d->movements_from_count) - ($d->active_maintenance_count + $d->movements_to_count)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="module">
        $('#spinner').hide();
        setTimeout(() => {
            $('#spinner').show();
            location.reload();
        }, 30000)
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/home.blade.php ENDPATH**/ ?>