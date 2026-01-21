<?php ($button = $button ?? true); ?>
<div class="row">
    <div class="col-md-12">
        <!-- Dati Principali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni CIG</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- CIG -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="cig"><?php echo e(__('Codice CIG')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="cig" id="cig"
                                class="form-control <?php $__errorArgs = ['cig'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('cig', $cig->cig ?? '')); ?>"
                                placeholder="CIG"
                                style="text-transform: uppercase;"
                                required>
                            <?php $__errorArgs = ['cig'];
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

                    <!-- Data -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <?php if (isset($component)) { $__componentOriginale69e472b1fdf480b1092c0d115ca0b31 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale69e472b1fdf480b1092c0d115ca0b31 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datetime-picker','data' => ['label' => 'Data CIG','name' => 'date','value' => ''.e(old('date', $cig?->date?->format('Y-m-d'))).'','type' => 'date']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datetime-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Data CIG','name' => 'date','value' => ''.e(old('date', $cig?->date?->format('Y-m-d'))).'','type' => 'date']); ?>
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
                            <?php $__errorArgs = ['date'];
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

                    <!-- Veicolo -->
                    <div class="col-md-6 mb-3">
                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['disabled' => ''.e(!$button).'','name' => 'car_id','required' => true,'value' => old('car_id', $cig->car_id ?? ''),'options' => $cars,'errors' => $errors,'endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modalUrl' => ''.e(route('car.getForm')).'','modalTitle' => 'Nuovo veicolo','modalClass' => 'modal-xl','onFilter' => 'carFilter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => ''.e(!$button).'','name' => 'car_id','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('car_id', $cig->car_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cars),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('car.storeForm')).'','label' => ''.e(__('Veicolo')).'','labelKey' => 'full_name','idKey' => 'id','modal-url' => ''.e(route('car.getForm')).'','modal-title' => 'Nuovo veicolo','modalClass' => 'modal-xl','onFilter' => 'carFilter']); ?>
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

                    <!-- Officina -->
                    <div class="col-md-6 mb-3">
                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['disabled' => ''.e(!$button).'','name' => 'maintenance_garage_id','required' => true,'value' => old('maintenance_garage_id', $cig->maintenance_garage_id ?? ''),'options' => $garages,'errors' => $errors,'endpoint' => ''.e(route('maintenance-garage.storeForm')).'','label' => ''.e(__('Officina')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('maintenance-garage.getForm')).'','modalTitle' => 'Nuova officina','modalClass' => 'modal-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => ''.e(!$button).'','name' => 'maintenance_garage_id','required' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('maintenance_garage_id', $cig->maintenance_garage_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($garages),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('maintenance-garage.storeForm')).'','label' => ''.e(__('Officina')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('maintenance-garage.getForm')).'','modal-title' => 'Nuova officina','modalClass' => 'modal-xl']); ?>
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

                    <!-- CE -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="ce"><?php echo e(__('Codice CE (opzionale)')); ?></label>
                            <input type="text" name="ce" id="ce"
                                class="form-control <?php $__errorArgs = ['ce'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('ce', $cig->ce ?? '')); ?>"
                                placeholder="Codice CE">
                            <?php $__errorArgs = ['ce'];
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

                    <!-- Descrizione -->
                    <div class="col-md-6 mb-3">
                        <div class="">
                            <label class="form-label" for="description"><?php echo e(__('Descrizione (opzionale)')); ?></label>
                            <input type="text" name="description" id="description"
                                class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('description', $cig->description ?? '')); ?>"
                                placeholder="Descrizione servizio">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Importi -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-currency-euro"></i> Importi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Imponibile -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="taxable"><?php echo e(__('Imponibile €')); ?></label>
                            <input type="text" name="taxable" id="taxable"
                                class="form-control <?php $__errorArgs = ['taxable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('taxable', $cig->taxable ?? '')); ?>"
                                placeholder="0,00">
                            <?php $__errorArgs = ['taxable'];
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

                    <!-- IVA -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="vat"><?php echo e(__('IVA € (22%)')); ?></label>
                            <input type="text" name="vat" id="vat"
                                class="form-control <?php $__errorArgs = ['vat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('vat', $cig->vat ?? '')); ?>"
                                placeholder="0,00"
                                readonly>
                            <?php $__errorArgs = ['vat'];
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

                    <!-- Totale -->
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <label class="form-label" for="total"><?php echo e(__('Totale €')); ?></label>
                            <input type="text" id="total"
                                class="form-control"
                                value="0,00"
                                readonly>
                            <?php $__errorArgs = ['total'];
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

        <!-- Responsabili -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-people"></i> Responsabili</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- RUP -->
                    <div class="col-md-6 mb-3">


                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'user_rup_id','value' => old('user_rup_id', $cig->user_rup_id ?? ''),'options' => $users,'errors' => $errors,'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('RUP')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('users.getForm')).'','modalTitle' => 'Nuovo utente','modalClass' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_rup_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('user_rup_id', $cig->user_rup_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('RUP')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('users.getForm')).'','modal-title' => 'Nuovo utente','modalClass' => 'modal-lg']); ?>
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

                    <!-- Supporto RUP -->
                    <div class="col-md-6 mb-3">
                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'user_support_id','value' => old('user_support_id', $cig->user_support_id ?? ''),'options' => $users,'errors' => $errors,'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Supporto RUP')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('users.getForm')).'','modalTitle' => 'Nuovo utente','modalClass' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_support_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('user_support_id', $cig->user_support_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Supporto RUP')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('users.getForm')).'','modal-title' => 'Nuovo utente','modalClass' => 'modal-lg']); ?>
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

                    <!-- Responsabile Bando -->
                    <div class="col-md-6 mb-3">
                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'user_tender_notice_id','value' => old('user_tender_notice_id', $cig->user_tender_notice_id ?? ''),'options' => $users,'errors' => $errors,'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Responsabile Bando')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('users.getForm')).'','modalTitle' => 'Nuovo utente','modalClass' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_tender_notice_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('user_tender_notice_id', $cig->user_tender_notice_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Responsabile Bando')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('users.getForm')).'','modal-title' => 'Nuovo utente','modalClass' => 'modal-lg']); ?>
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

                    <!-- Collaudatore -->
                    <div class="col-md-6 mb-3">
                        <?php if (isset($component)) { $__componentOriginale2077e9b010fd3c14859b436b957c967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2077e9b010fd3c14859b436b957c967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dynamic-select','data' => ['name' => 'user_tester_id','value' => old('user_tester_id', $cig->user_tester_id ?? ''),'options' => $users,'errors' => $errors,'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Collaudatore')).'','labelKey' => 'name','idKey' => 'id','modalUrl' => ''.e(route('users.getForm')).'','modalTitle' => 'Nuovo utente','modalClass' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_tester_id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('user_tester_id', $cig->user_tester_id ?? '')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users),'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors),'endpoint' => ''.e(route('users.storeForm')).'','label' => ''.e(__('Collaudatore')).'','labelKey' => 'name','idKey' => 'id','modal-url' => ''.e(route('users.getForm')).'','modal-title' => 'Nuovo utente','modalClass' => 'modal-lg']); ?>
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
    </div>

</div>
<?php if($button): ?>
<div class="row mt-3">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> <?php echo e(__('Salva CIG')); ?>

        </button>
        <a href="<?php echo e(route('cigs.index')); ?>" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> <?php echo e(__('Annulla')); ?>

        </a>
    </div>
</div>
<?php endif; ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        function carFilter(search   , options) {
            return options.filter(o =>
                o.full_name.toLowerCase().includes(search.toLowerCase()) ||
                (o.car_plates && o.car_plates.filter(p => p.name.toLowerCase().includes(search.toLowerCase())).length > 0)
            );
        }
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/cig/form.blade.php ENDPATH**/ ?>