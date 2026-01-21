<?php $__env->startSection('template_title'); ?>
    <?php echo e($maintenance->name ?? __('Dettagli Manutenzione')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-wrench"></i> <?php echo e(__('Dettagli Manutenzione')); ?>

                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="<?php echo e(route('maintenances.edit', $maintenance->id)); ?>">
                                    <i class="bi bi-pencil"></i> <?php echo e(__('Modifica')); ?>

                                </a>
                                <a class="btn btn-sm btn-primary" href="<?php echo e(route('maintenances.index')); ?>">
                                    <i class="bi bi-arrow-left"></i> <?php echo e(__('Torna alla Lista')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Informazioni Principali -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
                                        <div>

                                    <?php if (isset($component)) { $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-modal-form','data' => ['endpoint' => ''.e(route('cig.storeForm')).'','label' => ''.e(__('CIG')).'','url' => ''.e(route('cig.getForm', ['car_id' => $maintenance->car_id, 'maintenance_garage_id' => $maintenance->garage_id])).'','modalTitle' => 'Nuovo CIG','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'cig:inserted']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-modal-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['endpoint' => ''.e(route('cig.storeForm')).'','label' => ''.e(__('CIG')).'','url' => ''.e(route('cig.getForm', ['car_id' => $maintenance->car_id, 'maintenance_garage_id' => $maintenance->garage_id])).'','modalTitle' => 'Nuovo CIG','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'cig:inserted']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32)): ?>
<?php $attributes = $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32; ?>
<?php unset($__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32)): ?>
<?php $component = $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32; ?>
<?php unset($__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32); ?>
<?php endif; ?>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Stato:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <?php
                                                    $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                                ?>
                                                <?php if($isActive): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock"></i> In corso
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Completata
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Manutenzione:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0"><?php echo e($maintenance->maintenanceTypes?->name); ?></h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Veicolo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i>
                                                <a href="<?php echo e(route('cars.show', $maintenance->car_id)); ?>" class="text-decoration-none">
                                                 <?php echo e($maintenance->car?->full_name); ?>

                                                </a>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Targa:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <?php if($maintenance->car?->carPlates->count() > 0): ?>
                                                    <?php $__currentLoopData = $maintenance->car?->carPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge bg-primary"><?php echo e($plate->name); ?></span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <span class="text-muted">Nessuna targa attiva</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Officina:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i>
                                                <a href="<?php echo e(route('maintenance-garages.show', $maintenance->garage_id)); ?>" class="text-decoration-none">
                                                    <?php echo e($maintenance->maintenanceGarages?->name); ?>

                                                    <?php if($maintenance->maintenanceGarages?->address): ?>
                                                        <br>
                                                        <small class="text-muted"><?php echo e($maintenance->maintenanceGarages?->address); ?></small>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Periodo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-calendar"></i> <?php echo e($maintenance->date_from->format('d/m/Y')); ?>

                                                <?php if($maintenance->date_to): ?>
                                                    - <?php echo e($maintenance->date_to->format('d/m/Y')); ?>

                                                    <?php
                                                        $duration = $maintenance->date_from->diffInDays($maintenance->date_to) + 1;
                                                    ?>
                                                    <br><small class="text-muted">Durata: <?php echo e($duration); ?> <?php echo e($duration == 1 ? 'giorno' : 'giorni'); ?></small>
                                                <?php else: ?>
                                                    <br><small class="text-muted">Ancora in corso</small>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if($maintenance->description): ?>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($maintenance->description); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($maintenance->note): ?>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div>
                                                        <?php echo e($maintenance->note); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: <?php echo e($maintenance->created_at->format('d/m/Y H:i')); ?>

                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: <?php echo e($maintenance->updated_at->format('d/m/Y H:i')); ?>

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/maintenance/show.blade.php ENDPATH**/ ?>