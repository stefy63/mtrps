<?php $__env->startSection('template_title'); ?>
    Manutenzioni
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">


        
        <div class="row mb-4" x-data>
            <div class="col-12">
                    <div class="row g-2">
                        <div class="col-md-2 col-sm-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Totale Manutenzioni
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
                                            Totali in ditta
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['totalInGarage'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-clock-history fs-2 text-gray-300"></i>
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
                                            Totali in officina
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo e(number_format($stats['totalInHome'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-warning shadow h-100">
                            <div class="ps-2 card-title text-xs font-weight-bold text-warning text-uppercase">
                                Manutenzioni aperte
                            </div>
                            <div class="card-body p-1 h-100">
                                <div class="row no-gutters align-items-center">
                                    <div class="col m-0">
                                        <div class="mb-0 font-weight-bold ">
                                            <table class="table table-sm table-borderless m-0">
                                                <thead>
                                                    <tr class="text-center small text-warning">
                                                        <th class="text-warning">Oggi</th>
                                                        <th class="text-warning">Settimana</th>
                                                        <th class="text-warning">Mese</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="h5 text-center text-gray-800">
                                                        <td><?php echo e(number_format($stats['totalOpen_today'])); ?></td>
                                                        <td><?php echo e(number_format($stats['totalOpen_week'])); ?></td>
                                                        <td><?php echo e(number_format($stats['totalOpen_month'])); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300 me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-dark shadow h-100">
                            <div class="ps-2 card-title text-xs font-weight-bold text-dark text-uppercase">
                                Manutenzioni chiuse
                            </div>
                            <div class="card-body p-1 h-100">
                                <div class="row no-gutters align-items-center">
                                    <div class="col m-0">
                                        <div class="mb-0 font-weight-bold text-gray-800">
                                            <table class="table table-sm table-borderless m-0">
                                                <thead>
                                                    <tr class="text-center small text-dark">
                                                        <th class="text-dark">Oggi</th>
                                                        <th class="text-dark">Settimana</th>
                                                        <th class="text-dark">Mese</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="h5 text-center text-gray-800">
                                                        <td><?php echo e(number_format($stats['totalClosed_today'])); ?></td>
                                                        <td><?php echo e(number_format($stats['totalClosed_week'])); ?></td>
                                                        <td><?php echo e(number_format($stats['totalClosed_month'])); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle fs-2 text-gray-300 me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>




        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-wrench"></i> <?php echo e(__('Manutenzioni')); ?>

                            </span>

                            <div class="float-right">
                                <a href="<?php echo e(route('maintenances.create')); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> <?php echo e(__('Nuova Manutenzione')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <?php if (isset($component)) { $__componentOriginald388fb50d785f8c96a7087674ab9760e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald388fb50d785f8c96a7087674ab9760e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-search-button','data' => ['action' => ''.e(route('maintenances.index')).'','search' => ''.e(old('search', $search)).'','name' => 'inprogress','label' => 'Chiuse','check' => ''.e(old('inprogress', $inprogress)).'','enableCheck' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-search-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(route('maintenances.index')).'','search' => ''.e(old('search', $search)).'','name' => 'inprogress','label' => 'Chiuse','check' => ''.e(old('inprogress', $inprogress)).'','enableCheck' => 'true']); ?>
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
                        <?php if(count($maintenances) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th class="col-1">Stato</th>
                                        <th class="col-2">Veicolo</th>
                                        
                                        <th class="col-2">Tipo Manutenzione</th>
                                        <th class="col-1">Data Inizio</th>
                                        <th class="col-1">Data Fine</th>
                                        <th class="col-2">Officina</th>
                                        <th class="col-2">Assegnatario</th>
                                        
                                        <th class="col-1"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                        ?>
                                        <tr>
                                            <td>
                                                <?php if($isActive): ?>
                                                    <span class="badge bg-warning text-dark w-100">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="<?php echo e(route('cars.show', $maintenance->car_id)); ?>"
                                                       class="text-decoration-none">
                                                        <strong><?php echo e($maintenance->car?->full_name); ?></strong>
                                                    </a>
                                                    <?php if($maintenance->car?->carPlates->first()): ?>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="bi bi-credit-card"></i> <?php echo e($maintenance->car?->carPlates()->whereType('POLIZIA')->first()->name); ?>

                                                        </small>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <strong><?php echo e($maintenance->maintenanceTypes?->name ?? ''); ?></strong>
                                            </td>
                                            <td>
                                                <small><?php echo e(\Carbon\Carbon::parse($maintenance->date_from)->format('d/m/Y')); ?></small>
                                            </td>
                                            <td>
                                                <?php if($maintenance->date_to): ?>
                                                    <small><?php echo e(\Carbon\Carbon::parse($maintenance->date_to)->format('d/m/Y')); ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">In corso</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-truncate">
                                                <span data-bs-toggle="tooltip">

                                                <a href="<?php echo e(route('maintenance-garages.show', $maintenance->garage_id)); ?>"
                                                   class="text-decoration-none">
                                                    <?php echo e($maintenance->maintenanceGarages?->name ?? ''); ?>

                                                    <?php if($maintenance->maintenanceGarages?->address): ?>
                                                        <br>
                                                        <small class="text-muted"><?php echo e($maintenance->maintenanceGarages?->address); ?></small>
                                                    <?php endif; ?>
                                                </a>
                                                </span>
                                            </td>

                                            <td class="text-truncate">
                                                <span data-bs-toggle="tooltip">

                                                <a href="<?php echo e(route('offices.show', $maintenance->car?->carOffices?->first()?->id)); ?>"
                                                   class="text-decoration-none">
                                                    <?php echo e($maintenance->car?->carOffices?->first()?->ente ?? ''); ?>

                                                    <?php if($maintenance->car?->carOffices?->first()?->name): ?>
                                                        <br>
                                                        <small class="text-muted"><?php echo e($maintenance->car?->carOffices?->first()?->name); ?></small>
                                                    <?php endif; ?>
                                                </a>
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                <?php if($isActive): ?>
                                                    <?php if (isset($component)) { $__componentOriginalfbce4f648cc24125dc0d91a9692160ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-table-button','data' => ['item' => $maintenance,'label' => 'Manutenzione','itemRoute' => 'maintenances']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-table-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maintenance),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Manutenzione'),'itemRoute' => 'maintenances']); ?>
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
                                                <?php else: ?>
                                                    <a data-bs-toggle="tooltip" title="Visualizza dati Manutenzione" class="ms-2"
                                                       href="<?php echo e(route('maintenances.show', $maintenance->id)); ?>"><i
                                                            class="bi bi-search"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessuna manutenzione registrata.
                                <a href="<?php echo e(route('maintenances.create')); ?>" class="alert-link">Registra la prima
                                    manutenzione</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($maintenances->hasPages()): ?>
                    <div class="mt-3">
                        <?php echo $maintenances->withQueryString()->links(); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Inizializza i tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/maintenance/index.blade.php ENDPATH**/ ?>