<?php ($button = $button ?? true); ?>
<div class="padding-1 p-1">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general" aria-selected="true">Generali
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="assigne-tab" data-bs-toggle="tab" data-bs-target="#assigne" type="button"
                    role="tab" aria-controls="assigne" aria-selected="false">Assegnazioni
            </button>
        </li>
    </ul>
    <div class="tab-content" id="carTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row pt-3">
                <div class="col-md-6">

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_brand_id','class' => 'mb-2','required' => false,'value' => old('car_brand_id', $car?->car_brand_id),'options' => $carBrands,'errors' => $errors,'endpoint' => ''.e(route('car-brands.storeForm')).'','label' => ''.e(__('Marca')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-brands.getForm')).'','modalTitle' => 'Nuova Marca']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_brand_id','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-2'),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_brand_id', $car?->car_brand_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carBrands),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-brands.storeForm')).'','label' => ''.e(__('Marca')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-brands.getForm')).'','modal-title' => 'Nuova Marca']); ?>
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

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['required' => true,'name' => 'car_type_id','value' => old('car_type_id', $car?->car_type_id),'options' => $carTypes,'errors' => $errors,'endpoint' => ''.e(route('car-types.storeForm')).'','label' => ''.e(__('Modello')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-types.getForm')).'','modalTitle' => 'Nuova Tipologia di vettura']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'car_type_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_type_id', $car?->car_type_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carTypes),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-types.storeForm')).'','label' => ''.e(__('Modello')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-types.getForm')).'','modal-title' => 'Nuova Tipologia di vettura']); ?>
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

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['required' => true,'name' => 'car_owner_id','value' => old('car_owner_id', $car?->car_owner_id),'options' => $carOwners,'errors' => $errors,'endpoint' => ''.e(route('car-owners.storeForm')).'','label' => ''.e(__('Proprietario')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-owners.getForm')).'','modalTitle' => 'Nuovo proprietario']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'car_owner_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_owner_id', $car?->car_owner_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carOwners),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-owners.storeForm')).'','label' => ''.e(__('Proprietario')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-owners.getForm')).'','modal-title' => 'Nuovo proprietario']); ?>
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

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_power_id','required' => false,'value' => old('car_power_id', $car?->car_power_id),'options' => $carPowers,'errors' => $errors,'endpoint' => ''.e(route('car-powers.storeForm')).'','label' => ''.e(__('Alimentazione')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-powers.getForm')).'','modalTitle' => 'Nuovo tipo di alimentazione']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_power_id','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_power_id', $car?->car_power_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carPowers),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-powers.storeForm')).'','label' => ''.e(__('Alimentazione')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-powers.getForm')).'','modal-title' => 'Nuovo tipo di alimentazione']); ?>
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
                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_profit_account_id','modalClass' => 'modal-xl','required' => false,'value' => old('car_profit_account_id', $car?->car_profit_account_id),'options' => $carProfitAccounts,'errors' => $errors,'endpoint' => ''.e(route('car-profit-accounts.storeForm')).'','label' => ''.e(__('Conto Economico')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-profit-accounts.getForm')).'','modalTitle' => 'Nuovo conto economico']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_profit_account_id','modalClass' => 'modal-xl','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_profit_account_id', $car?->car_profit_account_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carProfitAccounts),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-profit-accounts.storeForm')).'','label' => ''.e(__('Conto Economico')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-profit-accounts.getForm')).'','modal-title' => 'Nuovo conto economico']); ?>
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

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_employment_code_id','required' => false,'value' => old('car_employment_code_id', $car?->car_employment_code_id),'options' => $carEmployment,'errors' => $errors,'endpoint' => ''.e(route('employment-code.storeForm')).'','label' => ''.e(__('Codice di impiego')).'','labelKey' => 'extended','idKey' => 'id','modalUrl' => ''.e(route('employment-code.getForm')).'','modalTitle' => 'Nuovo codice di impiego']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_employment_code_id','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_employment_code_id', $car?->car_employment_code_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carEmployment),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('employment-code.storeForm')).'','label' => ''.e(__('Codice di impiego')).'','labelKey' => 'extended','idKey' => 'id','modal-url' => ''.e(route('employment-code.getForm')).'','modal-title' => 'Nuovo codice di impiego']); ?>
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

                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_typology_id','required' => false,'value' => old('car_typology_id', $car?->car_typology_id),'options' => $carTypologies,'errors' => $errors,'endpoint' => ''.e(route('car-typology.storeForm')).'','label' => ''.e(__('Tipologia di mezzo')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-typology.getForm')).'','modalTitle' => 'Nuova tipologia di mezzo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_typology_id','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_typology_id', $car?->car_typology_id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($carTypologies),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-typology.storeForm')).'','label' => ''.e(__('Tipologia di mezzo')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-typology.getForm')).'','modal-title' => 'Nuova tipologia di mezzo']); ?>
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

                    <div class="form-group mb-2">
                        <label for="color" class="form-label"><?php echo e(__('Colore')); ?></label>
                        <input type="text" name="color" class="form-control <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('color', $car?->color)); ?>" id="color" placeholder="Colore">
                        <?php echo $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 " style="margin-top: 1.3rem">
                        <label for="available" class="form-label"><?php echo e(__('Stato vettura')); ?></label>
                        <div class="form-check">
                            <input type="hidden" name="available" value="0">
                            <input type="checkbox" name="available"
                                   class="form-check-input <?php $__errorArgs = ['available'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="1"
                                   id="available" <?php echo e(old('available', $car?->available) ? '' : 'checked'); ?>>
                            <label class="form-check-label" for="available">
                                FUORI USO
                            </label>
                        </div>
                        <?php echo $errors->first('winter_wheels', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group mb-2 ">
                        <label for="doc" class="form-label"><?php echo e(__('Data Documento')); ?></label>
                        <input type="date" name="date_assignee"
                               class="form-control <?php $__errorArgs = ['date_assignee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e($car?->carOffices[0]->pivot->date_from ?? date('Y-m-d')); ?>" id="doc">
                        <?php echo $errors->first('date_assignee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="tank" class="form-label"><?php echo e(__('Serbatoio (L)')); ?></label>
                        <input type="number" name="tank" class="form-control <?php $__errorArgs = ['tank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('tank', $car?->tank)); ?>" id="tank"
                               placeholder="Capacità serbatoio in litri"
                               min="0">
                        <?php echo $errors->first('tank', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="km" class="form-label"><?php echo e(__('Chilometraggio')); ?></label>
                        <input type="number" name="km" class="form-control <?php $__errorArgs = ['km'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('km', $car?->km)); ?>" id="km" placeholder="Chilometri percorsi" min="0">
                        <?php echo $errors->first('km', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 " style="margin-top: 1.3rem">
                        <label for="winter_wheels" class="form-label"><?php echo e(__('Pneumatici Invernali')); ?></label>
                        <div class="form-check">
                            <input type="hidden" name="winter_wheels" value="0">
                            <input type="checkbox" name="winter_wheels"
                                   class="form-check-input <?php $__errorArgs = ['winter_wheels'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="1"
                                   id="winter_wheels" <?php echo e(old('winter_wheels', $car?->winter_wheels) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="winter_wheels">
                                Dotato di pneumatici invernali
                            </label>
                        </div>
                        <?php echo $errors->first('winter_wheels', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="wheels_type" class="form-label"><?php echo e(__('Tipo Pneumatici')); ?></label>
                        <input type="text" name="wheels_type"
                               class="form-control <?php $__errorArgs = ['wheels_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('wheels_type', $car?->wheels_type)); ?>" id="wheels_type"
                               placeholder="Tipo pneumatici">
                        <?php echo $errors->first('wheels_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="warranty" class="form-label"><?php echo e(__('Garanzia')); ?></label>
                        <input type="text" name="warranty" class="form-control <?php $__errorArgs = ['warranty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('warranty', $car?->warranty)); ?>" id="warranty"
                               placeholder="Informazioni garanzia">
                        <?php echo $errors->first('warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="tel_warranty" class="form-label"><?php echo e(__('Telefono Assistenza')); ?></label>
                        <input type="text" name="tel_warranty"
                               class="form-control <?php $__errorArgs = ['tel_warranty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('tel_warranty', $car?->tel_warranty)); ?>" id="tel_warranty"
                               placeholder="Numero assistenza">
                        <?php echo $errors->first('tel_warranty', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="chassis" class="form-label"><?php echo e(__('Telaio')); ?></label>
                        <input type="text" name="chassis" class="form-control <?php $__errorArgs = ['chassis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('chassis', $car?->chassis)); ?>" id="chassis" placeholder="Numero telaio">
                        <?php echo $errors->first('chassis', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="date_revision" class="form-label"><?php echo e(__('Data Revisione')); ?></label>
                        <input type="date" name="date_revision"
                               class="form-control <?php $__errorArgs = ['date_revision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('date_revision', $car?->date_revision)); ?>" id="date_revision">
                        <?php echo $errors->first('date_revision', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                </div>
                <div class="col-md-12">

                    <div class="form-group mb-2 ">
                        <label for="description" class="form-label"><?php echo e(__('Descrizione')); ?></label>
                        <input type="text" name="description"
                               class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('description', $car?->description)); ?>" id="description"
                               placeholder="Descrizione veicolo">
                        <?php echo $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                    <div class="form-group mb-2 ">
                        <label for="note" class="form-label"><?php echo e(__('Note')); ?></label>
                        <textarea name="note" class="form-control <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="note"
                                  rows="3"
                                  placeholder="Note aggiuntive"><?php echo e(old('note', $car?->note)); ?></textarea>
                        <?php echo $errors->first('note', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

                    </div>

                </div>
            </div>
        </div>
        <div class="row tab-pane fade" id="assigne" role="tabpanel" aria-labelledby="assigne-tab">
            <div class="row pt-3">
                <div class="col-md-6">
                    <div class="input-group justify-content-between border border-info border-2 rounded-2 mb-3">
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_police_plate_id','modalClass' => 'modal-xl','required' => true,'value' => old('car_police_plate_id', $car_police_plate_id?->id),'options' => $polPlates,'errors' => $errors,'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Polizia')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::POLIZIA])).'','modalTitle' => 'Nuova targa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_police_plate_id','modalClass' => 'modal-xl','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_police_plate_id', $car_police_plate_id?->id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($polPlates),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Polizia')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::POLIZIA])).'','modal-title' => 'Nuova targa']); ?>
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
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_police_plate_force"
                                       type="checkbox" id="car_police_plate_force"
                                       value="1"
                                        <?php echo e(old('car_police_plate_force') == '1' ? 'checked' : ''); ?>

                                >
                                <label class="form-check-label" for="car_police_plate_force">Forza
                                    riassegnazione</label>
                            </div>
                        </div>
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_civil_plate_id','modalClass' => 'modal-xl','required' => false,'value' => old('car_civil_plate_id', $car_civil_plate_id?->id),'options' => $civPlates,'errors' => $errors,'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Civile')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::CIVILE])).'','modalTitle' => 'Nuova targa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_civil_plate_id','modalClass' => 'modal-xl','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_civil_plate_id', $car_civil_plate_id?->id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($civPlates),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Civile')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::CIVILE])).'','modal-title' => 'Nuova targa']); ?>
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
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_civil_plate_force"
                                       type="checkbox" id="car_civil_plate_force"
                                       value="1"
                                        <?php echo e(old('car_civil_plate_force') == '1' ? 'checked' : ''); ?>

                                >
                                <label class="form-check-label" for="car_civil_plate_force">Forza riassegnazione</label>
                            </div>
                        </div>
                        <div class="p-1 mb-3 mt-2 select-check" style="width: 33%">
                            <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'car_origin_plate_id','modalClass' => 'modal-xl','required' => false,'value' => old('car_origin_plate_id', $car_origin_plate_id?->id),'options' => $origPlates,'errors' => $errors,'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Originale')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::ORIGINALE])).'','modalTitle' => 'Nuova targa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'car_origin_plate_id','modalClass' => 'modal-xl','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_origin_plate_id', $car_origin_plate_id?->id)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($origPlates),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car-plates.storeForm')).'','label' => ''.e(__('Targa Originale')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('car-plates.getForm',['type' => \App\Enum\PlateTypeEnum::ORIGINALE])).'','modal-title' => 'Nuova targa']); ?>
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
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input"
                                       name="car_origin_plate_force"
                                       type="checkbox" id="car_origin_plate_force"
                                       value="1"
                                        <?php echo e(old('car_origin_plate_force') == '1' ? 'checked' : ''); ?>

                                >
                                <label class="form-check-label" for="car_origin_plate_force">Forza
                                    riassegnazione</label>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'assignee_id','required' => true,'value' => old('assignee_id', $car->carOffices[0]?->id ?? null),'options' => $offices,'errors' => $errors,'endpoint' => ''.e(route('offices.storeForm')).'','label' => ''.e(__('Assegnatario')).'','labelKey' => 'full_name','idKey' => 'id','modalUrl' => ''.e(route('offices.getForm')).'','modalTitle' => 'Nuovo Assegnatario']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'assignee_id','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('assignee_id', $car->carOffices[0]?->id ?? null)),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($offices),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('offices.storeForm')).'','label' => ''.e(__('Assegnatario')).'','labelKey' => 'full_name','idKey' => 'id','modal-url' => ''.e(route('offices.getForm')).'','modal-title' => 'Nuovo Assegnatario']); ?>
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
                <div class="col-md-6">
                    <div class="mb-3 text-end">
                        <?php if (isset($component)) { $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-modal-form','data' => ['endpoint' => ''.e(route('equipments.storeForm')).'','label' => ''.e(__('Nuovo Equipaggiamento')).'','url' => ''.e(route('equipments.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuovo Equipaggiamento','class' => 'btn-primary','icon' => 'bi-database-fill-add']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-modal-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['endpoint' => ''.e(route('equipments.storeForm')).'','label' => ''.e(__('Nuovo Equipaggiamento')).'','url' => ''.e(route('equipments.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuovo Equipaggiamento','class' => 'btn-primary','icon' => 'bi-database-fill-add']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32)): ?>
<?php $attributes = $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32; ?>
<?php unset($__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32)): ?>
<?php $component = $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32; ?>
<?php unset($__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32); ?>
<?php endif; ?>
                    </div>

                    <div class="list-group">
                        <div x-data="{
                                items: [],
                                equipments: <?php echo e(Js::from($equipments) ?? []); ?>,
                                carEquipments: <?php echo e(Js::from($car->carEquipment->pluck('id') ?? [])); ?>,
                                carById: <?php echo e(Js::from($carEquipmentById)); ?>,
                                init() {
                                    this.items = this.equipments.map(equipment => ({
                                        ...equipment,
                                        attivo: this.carEquipments.includes(equipment.id),
                                        note: this.carById[equipment.id]?.pivot.note || ''
                                    }));
                                }
                            }"
                             @button-modal-form.window="items.push($event.detail)"
                        >
                            <template x-for="(item, index) in items" :key="index">
                                <!-- Elementi -->
                                <div class="list-group-item d-flex align-items-center">
                                    <input class="form-check-input me-2 flex-shrink-0"
                                           x-model="item.attivo"
                                           type="checkbox" :id="item.id"
                                           :name="'equipments[' + item.id + '][attivo]'"
                                           :value="item.attivo?1:0"
                                    >
                                    <label :for="'label_' + item.id" class="flex-grow-1 mb-0 me-3"
                                           x-text="item.name"></label>
                                    <input type="text" class="form-control w-50"
                                           :id="'label_' + item.id"
                                           x-model="item.note"
                                           :name="'equipments[' + item.id + '][note]'"
                                           placeholder="Inserire dati..."
                                           :disabled="!item.attivo"
                                    >
                                </div>


                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($button): ?>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
        <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
    </div>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script type="module">

        $(document).on('brand:changed', function (e) {
            console.log("jQuery → brand:", e.originalEvent.detail);
        });

        document.querySelectorAll('.list-group-item input[type="checkbox"]').forEach(checkbox => {
            const textInput = checkbox.closest('.list-group-item').querySelector('input[type="text"]');
            textInput.disabled = !checkbox.checked;
            checkbox.addEventListener('change', () => {
                textInput.disabled = !checkbox.checked;
                // if (!checkbox.checked) textInput.value = '';
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/car/form.blade.php ENDPATH**/ ?>