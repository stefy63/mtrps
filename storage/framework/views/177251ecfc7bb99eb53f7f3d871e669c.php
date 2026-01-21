<?php $__env->startSection('template_title'); ?>
    Nuovo Movimento
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-plus-circle"></i> <?php echo e(__('Nuovo Movimento Veicolo')); ?>

                            </span>
                            <a href="<?php echo e(route('movements.index')); ?>" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-left"></i> Torna alla lista
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('movements.store')); ?>" role="form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <?php echo $__env->make('movement.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/movement/create.blade.php ENDPATH**/ ?>