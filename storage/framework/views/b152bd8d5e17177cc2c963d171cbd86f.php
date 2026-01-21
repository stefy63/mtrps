<?php $__env->startSection('template_title'); ?>
    <?php echo e($office->name ?? __('Show') . " " . __('Office')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Dati Ufficio')); ?> : <?php echo e($office?->full_name ?? ''); ?></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="<?php echo e(route('offices.edit', $office->id ?? 0)); ?>">
                                <i class="bi bi-pencil"></i> <?php echo e(__('Modifica')); ?>

                            </a>
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('offices.index')); ?>"> <?php echo e(__('Indice')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-office-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-office" type="button" role="tab" aria-controls="nav-office"
                                        aria-selected="true">Ufficio
                                </button>
                                <button class="nav-link" id="nav-car-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-car" type="button" role="tab"
                                        aria-controls="nav-car" aria-selected="false">Vetture
                                </button>
                                <button class="nav-link" id="nav-movement-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-movement" type="button" role="tab"
                                        aria-controls="nav-movement" aria-selected="false">Movimenti
                                </button>
                            </div>
                        </nav>


                        <div class="tab-content" id="nav-tabContent">
                            
                            <div class="tab-pane fade show active" id="nav-office" role="tabpanel"
                                 aria-labelledby="nav-office-tab">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="" style="display: flex; justify-content: space-between; align-items: center;">
                                                <div class="float-left">
                                                    <span class="">Dettagli Ufficio</span>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group mb-2 ">
                                                    <strong>Ente:</strong>
                                                    <?php echo e($office->ente); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Name:</strong>
                                                    <?php echo e($office->name); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Phone:</strong>
                                                    <?php echo e($office->phone); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Mail:</strong>
                                                    <?php echo e($office->mail); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Address:</strong>
                                                    <?php echo e($office->address); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Description:</strong>
                                                    <?php echo e($office->description); ?>

                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Note:</strong>
                                                    <?php echo e($office->note); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="nav-car" role="tabpanel"
                                 aria-labelledby="nav-car-tab">

                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-1">Targa</th>
                                        <th class="col-2">Modello</th>
                                        <th class="col-2">Tipologia</th>
                                        <th class="col-2">Colore</th>
                                        <th class="col-1">Km</th>
                                        <th class="col-4">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($office->cars->count()): ?>
                                        <?php $__currentLoopData = $office->cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-truncate">
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
                                                <td class="text-truncate"><?php echo e($car->full_name ?? ''); ?></td>
                                                <td class="text-truncate"><?php echo e($car->carTypology?->name ?? ''); ?></td>
                                                <td class="text-truncate"><?php echo e($car->color ?? ''); ?></td>
                                                <td><?php echo e($car->km ?? 0); ?></td>
                                                <td><?php echo e($car->note ?? ''); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="tab-pane fade" id="nav-movement" role="tabpanel"
                                 aria-labelledby="nav-movement-tab">
                                 <div class="row">
                                <div class="col-6">
                                <h5>Movimenti in uscita</h5>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($office->movementsTo)): ?>
                                        <?php $__currentLoopData = $office->movementsTo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $movement = $m->movements->first();
                                                $movementIsActive = !$movement?->date_to || $movement?->date_to >= now();
                                            ?> 
                                            <?php if($movement): ?>
                                            <tr>
                                                <td class="col-2">
                                                    <a href="<?php echo e(route('movements.edit', $movement?->id)); ?>"
                                                       class="text-decoration-none">
                                                        <strong><?php echo e($movement?->code); ?></strong>
                                                    </a>
                                                </td>
                                                <td class="col-3"><?php echo e($movement?->office->full_name); ?></td>
                                                <td class="col-2"><?php echo e(date('d/m/Y H:i', strtotime($movement?->date_from))); ?></td>
                                                <td class="col-2"  data-bs-toggle="tooltip" title="<?php echo e($movement?->date_to ? $movement?->date_to->format('d/m/Y H:i') : 'in corso'); ?>" >
                                                    <?php if($movementIsActive): ?>
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    <?php endif; ?>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                                </div>


                                <div class="col-6">
                                <h5>Movimenti in ingresso</h5>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($office->movement)): ?>
                                        <?php $__currentLoopData = $office->movement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $movementIsActive = !$m->date_to || $m->date_to >= now();
                                            ?>
                                            <tr>
                                                <td class="col-2">
                                                    <a href="<?php echo e(route('movements.edit', $m->id)); ?>"
                                                       class="text-decoration-none">
                                                        <strong><?php echo e($m->code); ?></strong>
                                                    </a>
                                                </td>
                                                <td class="col-3"><?php echo e($m->office->full_name); ?></td>
                                                <td class="col-2"><?php echo e(date('d/m/Y H:i', strtotime($m->date_from))); ?></td>
                                                <td class="col-2"  data-bs-toggle="tooltip" title="<?php echo e($m->date_to ? $m->date_to->format('d/m/Y H:i') : 'in corso'); ?>" >
                                                    <?php if($movementIsActive): ?>
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/office/show.blade.php ENDPATH**/ ?>