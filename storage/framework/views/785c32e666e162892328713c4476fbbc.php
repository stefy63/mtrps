<?php ($button = $button ?? true); ?>
<div class="row padding-1 p-1">
    <div class="col-md-12">

        
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-info-circle"></i> Informazioni Movimento
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="code"
                                   class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('code', $movement?->code)); ?>"
                                   id="code"
                                   placeholder="Codice"
                                   readonly>
                            <label for="code"><?php echo e(__('Codice Movimento')); ?></label>
                            <?php echo $errors->first('code', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                        </div>
                    </div>
                    
                    <div class="col-md-1 ms-auto">

                            <div class="form-check form-switch mt-3">
                                <input
                                    value="1"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="validated"
                                    name="validated"
                                    <?php echo e(old('validated', $movement?->validated) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="validated">Convalidato</label>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <i class="bi bi-truck"></i> Veicolo e Personale
            </div>
            <div class="card-body">
                <div class="row">

                    
                    <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_id','modalClass' => 'modal-xl','disabled' => ''.e(!$button).'','required' => true,'value' => old('car_id', $movement?->car_id),'options' => $cars,'errors' => $errors,'endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modalUrl' => ''.e(route('car.getForm')).'','modalTitle' => 'Nuova Vettura','onFilter' => 'carFilter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_id','modalClass' => 'modal-xl','disabled' => ''.e(!$button).'','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_id', $movement?->car_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cars),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modal-url' => ''.e(route('car.getForm')).'','modal-title' => 'Nuova Vettura','onFilter' => 'carFilter']); ?>
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


                    <div class="<?php if($button): ?>col-md-6 <?php else: ?> col-md-12 <?php endif; ?>">

                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'office_id','required' => true,'value' => old('office_id', $movement?->office_id),'options' => $offices,'errors' => $errors,'endpoint' => ''.e(route('offices.storeForm')).'','label' => ''.e(__('Ufficio Destinatario')).'','labelKey' => 'full_name','idKey' => 'id','modalUrl' => ''.e(route('offices.getForm')).'','modalTitle' => 'Nuovo Ufficio']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'office_id','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('office_id', $movement?->office_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($offices),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('offices.storeForm')).'','label' => ''.e(__('Ufficio Destinatario')).'','labelKey' => 'full_name','idKey' => 'id','modal-url' => ''.e(route('offices.getForm')).'','modal-title' => 'Nuovo Ufficio']); ?>
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

                </div>
            </div>
        </div>

        
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <i class="bi bi-calendar-event"></i> Date e Orari
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <?php if (isset($component)) { $__componentOriginale69e472b1fdf480b1092c0d115ca0b31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datetime-picker','data' => ['required' => 'true','label' => 'Data e ora inizio','altFormat' => 'd/m/Y H:i','name' => 'date_from','value' => ''.e(old('date_from', $movement?->date_from?->format('Y-m-d H:i'))).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datetime-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => 'true','label' => 'Data e ora inizio','altFormat' => 'd/m/Y H:i','name' => 'date_from','value' => ''.e(old('date_from', $movement?->date_from?->format('Y-m-d H:i'))).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $attributes = $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $component = $__componentOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
                            <?php echo $errors->first('date_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                        </div>
                    </div>

                    
                    <div class="col-md-3">
                        <div class="form-floating mb-3">

                            <?php if (isset($component)) { $__componentOriginale69e472b1fdf480b1092c0d115ca0b31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datetime-picker','data' => ['label' => 'Data e ora fine','name' => 'date_to','value' => ''.e(old('date_to', $movement?->date_to?->format('Y-m-d H:i'))).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datetime-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Data e ora fine','name' => 'date_to','value' => ''.e(old('date_to', $movement?->date_to?->format('Y-m-d H:i'))).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $attributes = $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__attributesOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31)): ?>
<?php $component = $__componentOriginale69e472b1fdf480b1092c0d115ca0b31; ?>
<?php unset($__componentOriginale69e472b1fdf480b1092c0d115ca0b31); ?>
<?php endif; ?>
                            <?php echo $errors->first('date_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div id="availability-alert" class="alert d-none" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span id="availability-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if($button): ?>
        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> <?php echo e(__('Salva Movimento')); ?>

            </button>
            <a href="<?php echo e(route('movements.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> <?php echo e(__('Annulla')); ?>

            </a>
        </div>
    <?php endif; ?>
</div><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/movement/form.blade.php ENDPATH**/ ?>