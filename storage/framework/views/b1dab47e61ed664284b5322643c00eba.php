<?php $__env->startSection('template_title'); ?>
    Movimenti Veicoli
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        
        <div class="row mb-4" x-data>
            <form x-ref="filterForm" action="<?php echo e(route('movements.index')); ?>" method="GET">
                <input type="hidden" name="search" value="<?php echo e(old('search', $search)); ?>">
                <input type="hidden" name="inprogress" value="<?php echo e(old('inprogress', $inprogress)); ?>">
                <div class="col-12">
                    <div class="row g-2">
                        <div class="col-md-2 col-sm-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Totali
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['total'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-truck fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            In Attesa
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['pending'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-hourglass-split fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            In Corso
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['in_progress'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Termine Oggi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['end_today'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="form-check form-switch">
                                                <input 
                                                    <?php if(old('end_today', $end_today)): ?>
                                                    checked
                                                    <?php endif; ?>                                                       class="form-check-input"
                                                    type="checkbox"
                                                    name="end_today"
                                                    @change="$refs.filterForm.submit()"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            Iniziano Oggi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['start_today'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="form-check form-switch">
                                                <input 
                                                    <?php if(old('start_today', $start_today)): ?>
                                                    checked
                                                    <?php endif; ?>
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="start_today"
                                                    @change="$refs.filterForm.submit()"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Completati (<?php echo e(now()->format('F')); ?>)
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['completed_month'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </form>
        </div>

        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo e(__('Movimenti Veicoli')); ?>

                            </span>

                            <div class="float-right">
                                <a href="<?php echo e(route('movements.create')); ?>" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Nuovo Movimento">
                                    <i class="bi bi-plus-circle"></i> <?php echo e(__('Nuovo Movimento')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="row mb-3">
                            <div class="col-12">

                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <?php if (isset($component)) { $__componentOriginald388fb50d785f8c96a7087674ab9760e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald388fb50d785f8c96a7087674ab9760e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-search-button','data' => ['action' => ''.e(route('movements.index')).'','search' => ''.e(old('search', $search)).'','name' => 'inprogress','label' => 'Terminate','check' => ''.e(old('inprogress', $inprogress)).'','enableCheck' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-search-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(route('movements.index')).'','search' => ''.e(old('search', $search)).'','name' => 'inprogress','label' => 'Terminate','check' => ''.e(old('inprogress', $inprogress)).'','enableCheck' => 'true']); ?>
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
                            </div>
                        </div>

                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th class="col-2">
                                        <a href="<?php echo e(route('movements.index', array_merge(request()->all(), ['sort' => 'code', 'direction' => request('sort') == 'code' && request('direction') == 'asc' ? 'desc' : 'asc']))); ?>"
                                           class="text-decoration-none text-dark">
                                            Codice
                                        </a>
                                    </th>
                                    <th class="col-1">Stato</th>
                                    <th class="col-2">Veicolo</th>
                                    <th class="col-2">Assegnatario</th>
                                    <th class="col-2">Ufficio Destinatario</th>
                                    <th class="col-1">Dal</th>
                                    <th class="col-1">Al</th>
                                    <th class="text-end col-1">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('movements.show', $movement->id)); ?>"
                                               class="text-decoration-none">
                                                <strong><?php echo e($movement->code); ?></strong>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if($movement->date_to && $movement->date_to < now()): ?>
                                                <?php if($movement->validated): ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-arrow-left"></i> Restituita
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-key"></i> Non Restituita
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($movement->date_from > now()): ?>
                                                    <span class="badge bg-warning">
                                                        <i class="bi bi-hourglass-split"></i> In Attesa
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-clock-history"></i> In Uso
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('cars.show', $movement->car_id)); ?>"
                                                   class="text-decoration-none">
                                                    <strong><?php echo e($movement->car?->full_name); ?></strong>
                                                </a>
                                                <?php if($movement->car?->carPlates->first()): ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="bi bi-credit-card"></i> <?php echo e($movement->car?->carPlates()->whereType('POLIZIA')->first()->name); ?>

                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('offices.show', $movement->car?->carOffices[0]->id)); ?>"
                                                   class="text-decoration-none">
                                                <?php echo e($movement->car?->carOffices[0]->full_name ?? ''); ?>

                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('offices.show', $movement->office_id)); ?>"
                                                   class="text-decoration-none">
                                                <?php echo e($movement->office?->full_name ?? ''); ?>

                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php echo e($movement->date_from ? $movement->date_from->format('d/m/Y H:i') : '-'); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php echo e($movement->date_to ? $movement->date_to->format('d/m/Y H:i') : 'in corso'); ?>

                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <?php if(!$movement->validated): ?>
                                                <div class="btn-group dropstart">
                                                    <?php if (isset($component)) { $__componentOriginalfbce4f648cc24125dc0d91a9692160ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-table-button','data' => ['item' => $movement,'label' => 'Movimento']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-table-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($movement),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Movimento')]); ?>
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
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <i class="bi bi-inbox fs-1 text-muted"></i>
                                            <p class="text-muted">Nessun movimento trovato</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <?php echo $movements->withQueryString()->links(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/movement/index.blade.php ENDPATH**/ ?>