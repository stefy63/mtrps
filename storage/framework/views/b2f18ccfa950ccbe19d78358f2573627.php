<?php $__env->startSection('template_title'); ?>
    Modifica Movimento <?php echo e($movement->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-pencil"></i> <?php echo e(__('Modifica Movimento')); ?>: <strong><?php echo e($movement->code); ?></strong>
                            </span>
                            <div>
                                <a href="<?php echo e(route('movements.show', $movement->id)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Visualizza
                                </a>
                                <a href="<?php echo e(route('movements.index')); ?>" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Torna alla lista
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <?php if(in_array($movement->status, ['in_progress', 'completed'])): ?>
                            <div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Attenzione:</strong> Questo movimento è <?php echo e($movement->status_label); ?>.
                                Alcune modifiche potrebbero non essere consentite.
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('movements.update', $movement->id)); ?>" role="form" enctype="multipart/form-data">
                            <?php echo e(method_field('PATCH')); ?>

                            <?php echo csrf_field(); ?>

                            <?php echo $__env->make('movement.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/movement/edit.blade.php ENDPATH**/ ?>