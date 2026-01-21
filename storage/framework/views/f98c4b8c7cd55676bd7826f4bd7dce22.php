<?php ($button = $button ?? true); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Veicolo -->
                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_id','required' => true,'disabled' => ''.e(!$button).'','value' => old('car_id', $maintenance?->car_id),'options' => $cars,'errors' => $errors,'modalClass' => 'modal-xl ','endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modalUrl' => ''.e(route('car.getForm')).'','modalTitle' => 'Nuova Vettura','onFilter' => 'carFilter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_id','required' => true,'disabled' => ''.e(!$button).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_id', $maintenance?->car_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cars),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'modal-class' => 'modal-xl ','endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modal-url' => ''.e(route('car.getForm')).'','modal-title' => 'Nuova Vettura','onFilter' => 'carFilter']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $attributes = $__attributesOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__attributesOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $component = $__componentOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__componentOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
                </div>

                <div class="row mb-3">
                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'garage_id','required' => true,'value' => old('garage_id', $maintenance?->garage_id),'options' => $garages,'errors' => $errors,'modalClass' => 'modal-xl','endpoint' => ''.e(route('maintenance-garage.storeForm')).'','label' => ''.e(__('Officina')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('maintenance-garage.getForm')).'','modalTitle' => 'Nuova Officina']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'garage_id','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('garage_id', $maintenance?->garage_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($garages),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'modal-class' => 'modal-xl','endpoint' => ''.e(route('maintenance-garage.storeForm')).'','label' => ''.e(__('Officina')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('maintenance-garage.getForm')).'','modal-title' => 'Nuova Officina']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $attributes = $__attributesOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__attributesOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $component = $__componentOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__componentOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
                </div>

                <div class="row mb-3">
                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'type_id','required' => false,'value' => old('type_id', $maintenance?->type_id),'options' => $types,'errors' => $errors,'endpoint' => ''.e(route('maintenance-type.storeForm')).'','label' => ''.e(__('Tipologia')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('maintenance-type.getForm')).'','modalTitle' => 'Nuova Tipologia']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'type_id','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('type_id', $maintenance?->type_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($types),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('maintenance-type.storeForm')).'','label' => ''.e(__('Tipologia')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('maintenance-type.getForm')).'','modal-title' => 'Nuova Tipologia']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $attributes = $__attributesOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__attributesOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2077e9b010fd3c14859b436b957c967)): ?>
<?php $component = $__componentOriginale2077e9b010fd3c14859b436b957c967; ?>
<?php unset($__componentOriginale2077e9b010fd3c14859b436b957c967); ?>
<?php endif; ?>
                </div>

                <div class="row mb-3">
                    <div class="">
                        <label for="description"><?php echo e(__('Descrizione (opzionale)')); ?></label>
                        <input type="text" name="description" id="description"
                               class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('description', $maintenance->description ?? '')); ?>"
                               placeholder="Es: Cambio olio, filtri e controllo generale">
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div id="description-suggestions" class="mt-2"></div>
                </div>
                <div class="row mb-3">
                    <!-- Data Inizio -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="date_from" id="date_from"
                                   class="form-control <?php $__errorArgs = ['date_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('date_from', isset($maintenance) && $maintenance->date_from ? $maintenance->date_from->format('Y-m-d') : date('Y-m-d'))); ?>"
                                   required>
                            <label for="date_from"><?php echo e(__('Data Inizio')); ?> <span class="text-danger">*</span></label>
                            <?php $__errorArgs = ['date_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Data Fine -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="date_to" id="date_to"
                                   class="form-control <?php $__errorArgs = ['date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('date_to', isset($maintenance) && $maintenance->date_to ? $maintenance->date_to->format('Y-m-d') : '')); ?>">
                            <label for="date_to"><?php echo e(__('Data Fine (opzionale)')); ?></label>
                            <?php $__errorArgs = ['date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <small class="text-muted">Lascia vuoto se la manutenzione è ancora in corso</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Note -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                      class="form-control <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      style="height: 100px"
                                      placeholder="Note aggiuntive..."><?php echo e(old('note', $maintenance->note ?? '')); ?></textarea>
                            <label for="note"><?php echo e(__('Note (opzionale)')); ?></label>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($button): ?>
        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> <?php echo e(__('Salva Manutenzione')); ?>

                </button>
                <a href="<?php echo e(route('maintenances.index')); ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> <?php echo e(__('Annulla')); ?>

                </a>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/maintenance/form.blade.php ENDPATH**/ ?>