<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Nuovo CIG')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-file-earmark-text"></i> <?php echo e(__('Nuovo CIG')); ?>

                            </span>
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('cigs.index')); ?>">
                                <i class="bi bi-arrow-left"></i> <?php echo e(__('Torna alla Lista')); ?>

                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('cigs.store')); ?>" role="form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <?php if(request()->has('maintenance_garage_id')): ?>
                                <input type="hidden" name="redirect_to_garage" value="1">
                            <?php endif; ?>

                            <?php echo $__env->make('cig.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/cig/create.blade.php ENDPATH**/ ?>