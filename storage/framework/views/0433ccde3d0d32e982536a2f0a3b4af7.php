<?php $__env->startSection('template_title'); ?>
    Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <?php echo e(__('Users')); ?>

                            </span>

                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                            <div class="float-right">
                                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    <?php echo e(__('Create New')); ?>

                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="col-1"><?php echo e(++$i); ?></td>
                                        <td class="col-4"><?php echo e($user->name); ?></td>
                                        <td class="col-5"><?php echo e($user->email); ?></td>
                                        <td class="text-end">
                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'pippo')): ?>  
                                            <?php if (isset($component)) { $__componentOriginalfbce4f648cc24125dc0d91a9692160ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbce4f648cc24125dc0d91a9692160ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-table-button','data' => ['item' => $user,'label' => 'Utente']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-table-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Utente')]); ?>
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
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo $users->withQueryString()->links(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/user/index.blade.php ENDPATH**/ ?>