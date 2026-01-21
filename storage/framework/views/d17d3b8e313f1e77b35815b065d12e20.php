<?php $__env->startSection('template_title'); ?>
    CIG - Codici Identificativi Gara
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-file-earmark-text"></i> <?php echo e(__('CIG - Codici Identificativi Gara')); ?>

                            </span>

                            <div class="float-right">
                                
                                <a href="<?php echo e(route('cigs.create')); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> <?php echo e(__('Nuovo CIG')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Totali -->
                    <div class="card-header bg-light">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale CIG</h6>
                                <h4 class="mb-0 text-primary"><?php echo e($totals['count']); ?></h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Imponibile Totale</h6>
                                <h4 class="mb-0 text-success">€ <?php echo e(number_format($totals['taxable'], 2, ',', '.')); ?></h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">IVA Totale</h6>
                                <h4 class="mb-0 text-info">€ <?php echo e(number_format($totals['vat'], 2, ',', '.')); ?></h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale Complessivo</h6>
                                <h4 class="mb-0 text-danger">€ <?php echo e(number_format($totals['total'], 2, ',', '.')); ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <?php if (isset($component)) { $__componentOriginald388fb50d785f8c96a7087674ab9760e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald388fb50d785f8c96a7087674ab9760e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-search-button','data' => ['action' => ''.e(route('cigs.index')).'','search' => ''.e(old('search', $search)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-search-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(route('cigs.index')).'','search' => ''.e(old('search', $search)).'']); ?>
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
                        <?php if(count($cigs) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>CIG</th>
                                            <th>Data</th>
                                            <th>Veicolo</th>
                                            <th>Officina</th>
                                            <th>Descrizione</th>
                                            <th>Importi</th>
                                            <th>RUP</th>
                                            <th>Responsabili</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $cigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <strong class="text-primary"><?php echo e($cig->cig); ?></strong>
                                                    <?php if($cig->ce): ?>
                                                        <br><small class="text-muted">CE: <?php echo e($cig->ce); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($cig->date): ?>
                                                        <?php echo e($cig->date->format('d/m/Y')); ?>

                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <small><?php echo e($cig->car->full_name); ?></small>
                                                    <?php if($cig->car->carPlates->count() > 0): ?>
                                                        <br><span class="badge bg-primary"><?php echo e($cig->car->carPlates[0]->name); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <small><?php echo e($cig->maintenanceGarage->name); ?></small>
                                                    <?php if($cig->maintenanceGarage->piva): ?>
                                                        <br><small class="text-muted">P.IVA: <?php echo e($cig->maintenanceGarage->piva); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($cig->description): ?>
                                                        <small><?php echo e(Str::limit($cig->description, 50)); ?></small>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($cig->taxable): ?>
                                                        <small>Imp: € <?php echo e(number_format($cig->taxable, 2, ',', '.')); ?></small><br>
                                                        
                                                        <strong>Tot: € <?php echo e(number_format($cig->taxable + $cig->vat, 2, ',', '.')); ?></strong>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($cig->userRup): ?>
                                                        <small><strong>RUP:</strong> <?php echo e($cig->userRup->name); ?></small>
                                                    <?php endif; ?>
                                                    <?php if($cig->userSupport): ?>
                                                        <br><small><strong>Supp:</strong> <?php echo e($cig->userSupport->name); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($cig->userTenderNotice): ?>
                                                        <small><strong>Resp:</strong> <?php echo e($cig->userTenderNotice->name); ?></small>
                                                    <?php endif; ?>
                                                    <?php if($cig->userTester): ?>
                                                        <br><small><strong>Coll:</strong> <?php echo e($cig->userTester->name); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end">
                                                    <?php if (isset($component)) { $__componentOriginalfbce4f648cc24125dc0d91a9692160ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-table-button','data' => ['itemRoute' => 'cigs','item' => $cig]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-table-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['itemRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('cigs'),'item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cig)]); ?>
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
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessun CIG registrato.
                                <a href="<?php echo e(route('cigs.create')); ?>" class="alert-link">Registra il primo CIG</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($cigs->hasPages()): ?>
                    <div class="mt-3">
                        <?php echo $cigs->withQueryString()->links(); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/cig/index.blade.php ENDPATH**/ ?>