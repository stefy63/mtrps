<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Nuova Manutenzione')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-wrench"></i> <?php echo e(__('Nuova Manutenzione')); ?>

                            </span>
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('maintenances.index')); ?>">
                                <i class="bi bi-arrow-left"></i> <?php echo e(__('Torna alla Lista')); ?>

                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('maintenances.store')); ?>" role="form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <?php echo $__env->make('maintenance.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/maintenance/create.blade.php ENDPATH**/ ?>