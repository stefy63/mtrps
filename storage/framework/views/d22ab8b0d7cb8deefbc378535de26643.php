<?php $__env->startSection('template_title'); ?>
    <?php echo e(__('Update')); ?> Car
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><?php echo e(__('Modifica Vettura')); ?> : <?php echo e($car->carBrand?->name); ?></span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="<?php echo e(route('cars.update', $car->id)); ?>"  role="form" enctype="multipart/form-data">
                            <?php echo e(method_field('PATCH')); ?>

                            <?php echo csrf_field(); ?>

                            <?php echo $__env->make('car.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.querySelectorAll('.select-check')
            .forEach((container) => {
                const select = container.querySelector('input[name$="_plate_id"]');
                const checkbox = container.querySelector('input[type="checkbox"]')
                // checkbox.disabled = true;
                select.addEventListener('change', function() {
                    setTimeout(() => {
                        checkbox.disabled = !this.value;
                    });
                });

            })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/car/edit.blade.php ENDPATH**/ ?>