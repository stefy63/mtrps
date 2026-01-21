<?php $__env->startSection('template_title'); ?>
    <?php echo e($car->name ?? __('Show') . " " . __('Car')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Dati Vettura')); ?> : <?php echo e($car?->full_name ?? ''); ?></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="<?php echo e(route('cars.edit', $car->id ?? 0)); ?>">
                                <i class="bi bi-pencil"></i> <?php echo e(__('Modifica')); ?>

                            </a>
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('cars.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-car-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-car" type="button" role="tab" aria-controls="nav-car"
                                        aria-selected="true">Vettura
                                </button>
                                <button class="nav-link" id="nav-movement-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-movement" type="button" role="tab"
                                        aria-controls="nav-movement" aria-selected="false">Movimenti
                                </button>
                                <button class="nav-link" id="nav-maintenance-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-maintenance" type="button" role="tab"
                                        aria-controls="nav-maintenance" aria-selected="false">Manutenzioni
                                </button>
                            </div>
                        </nav>


                        <div class="tab-content" id="nav-tabContent">
                            
                            <div class="tab-pane fade show active" id="nav-car" role="tabpanel"
                                 aria-labelledby="nav-car-tab">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group mb-2">
                                            <strong>Marca:</strong>
                                            <?php echo e($car->carBrand?->name ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Tipo Veicolo:</strong>
                                            <?php echo e($car->carType?->name ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Proprietario:</strong>
                                            <?php echo e($car->carOwner?->name ?? 'N/A'); ?>

                                        </div>


                                        <div class="form-group mb-2">
                                            <strong>Alimentazione:</strong>
                                            <?php echo e($car->carPower?->name ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Conto:</strong>
                                            <?php echo e($car->profit_account ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Tipologia di Mezzo:</strong>
                                            <?php echo e($car->car_typology ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Colore:</strong>
                                            <?php echo e($car->color ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Serbatoio:</strong>
                                            <?php echo e($car->tank ? $car->tank . ' L' : 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Chilometraggio:</strong>
                                            <?php echo e($car->km ? number_format($car->km) . ' km' : 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Pneumatici Invernali:</strong>
                                            <span class="badge badge-<?php echo e($car->winter_wheels ? 'success' : 'secondary'); ?>">
                                        <?php echo e($car->winter_wheels ? 'Sì' : 'No'); ?>

                                    </span>
                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Tipo Pneumatici:</strong>
                                            <?php echo e($car->wheels_type ?? 'N/A'); ?>

                                        </div>

                                    </div>

                                    <div class="col-md-6">


                                        <div class="form-group mb-2">
                                            <strong>Garanzia:</strong>
                                            <?php echo e($car->warranty ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Telefono Assistenza:</strong>
                                            <?php echo e($car->tel_warranty ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Telaio:</strong>
                                            <?php echo e($car->chassis ?? 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Data Revisione:</strong>
                                            <?php echo e($car->date_revision ? \Carbon\Carbon::parse($car->date_revision)->format('d/m/Y') : 'N/A'); ?>

                                        </div>

                                        <div class="form-group mb-2">
                                            <strong>Targhe:</strong>
                                            <?php $__currentLoopData = $car->carPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row ms-3">
                                                    <span class="col-4 text-decoration-underline"><?php echo e($c->type); ?>:</span>
                                                    <strong class="col"><?php echo e($c->name); ?></strong>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <?php if($car->carOffices->count() > 0): ?>
                                            <div class="form-group mb-2">
                                                <strong>Assegnatario:</strong>
                                                <?php echo e($car->carOffices[0]->full_name); ?>

                                            </div>
                                        <?php endif; ?>

                                        <?php if($car->carEquipment): ?>
                                            <div class="form-group mb-2">
                                                <strong>Equipaggiamento:</strong>
                                                <?php $__currentLoopData = $car->carEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="ms-3 row">
                                                        <span class="col-4 text-decoration-underline"><?php echo e($c->name); ?>:</span>
                                                        <strong class="col"><?php echo e($c->pivot->note); ?></strong>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($car->description): ?>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <strong>Descrizione:</strong>
                                                <p><?php echo e($car->description); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($car->note): ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-2"
                                                 x-data="{note: '<?php echo e(str_replace(["\r\n", "\n", "\r"], '<br>', $car->note)); ?>'}">
                                                <strong>Note:</strong>
                                                <p x-html="note"></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <small class="text-muted">
                                                <strong>Creato:</strong> <?php echo e($car->created_at->format('d/m/Y H:i')); ?> |
                                                <strong>Aggiornato:</strong> <?php echo e($car->updated_at->format('d/m/Y H:i')); ?>

                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="nav-movement" role="tabpanel"
                                 aria-labelledby="nav-movement-tab">
                                <div class="text-end m-2">

                                    <?php if (isset($component)) { $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-modal-form','data' => ['endpoint' => ''.e(route('movement.storeForm')).'','label' => ''.e(__('Movimento')).'','url' => ''.e(route('movement.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuovo Movimento','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'movement:inserted']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-modal-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['endpoint' => ''.e(route('movement.storeForm')).'','label' => ''.e(__('Movimento')).'','url' => ''.e(route('movement.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuovo Movimento','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'movement:inserted']); ?>
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
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($car->movements)): ?>
                                        <?php $__currentLoopData = $car->movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $movementIsActive = !$m->date_to || $m->date_to >= now();
                                            ?>
                                            <tr>
                                                <td class="col-2">
                                                    <a href="<?php echo e(route('movements.edit', $m->id)); ?>"
                                                       class="text-decoration-none">
                                                        <strong><?php echo e($m->code); ?></strong>
                                                    </a>
                                                </td>
                                                <td class="col-3"><?php echo e($m->office->full_name); ?></td>
                                                <td class="col-2"><?php echo e(date('d/m/Y H:i', strtotime($m->date_from))); ?></td>
                                                <td class="col-2"  data-bs-toggle="tooltip" title="<?php echo e($m->date_to ? $m->date_to->format('d/m/Y H:i') : 'in corso'); ?>" >
                                                    <?php if($movementIsActive): ?>
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    <?php endif; ?>

                                                <td class="col-3"><?php echo e($m->note); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="tab-pane fade" id="nav-maintenance" role="tabpanel"
                                 aria-labelledby="nav-maintenance-tab">

                                <div class="text-end m-2">
                                    <?php if (isset($component)) { $__componentOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaffa8804c250c0b9e2ca2cb29a9b7f32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-modal-form','data' => ['endpoint' => ''.e(route('maintenance.storeForm')).'','label' => ''.e(__('Manutenzioni')).'','url' => ''.e(route('maintenance.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuova Manutenzione','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'maintenance:inserted']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-modal-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['endpoint' => ''.e(route('maintenance.storeForm')).'','label' => ''.e(__('Manutenzioni')).'','url' => ''.e(route('maintenance.getForm', ['car_id' => $car->id])).'','modalTitle' => 'Nuova Manutenzione','modalClass' => 'modal-xl','class' => 'btn-primary','icon' => 'bi-database-fill-add','event' => 'maintenance:inserted']); ?>
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
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-2">Officina</th>
                                        <th class="col-2">Indirizzo</th>
                                        <th class="col-1">Telefoni</th>
                                        <th class="col-2">Mail/PEC</th>
                                        <th class="col-1">Tipo intervento</th>
                                        <th class="col-1">Dal</th>
                                        <th class="col-1">Al</th>
                                        <th class="col-2">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($car->maintenances->count()): ?>
                                        <?php $__currentLoopData = $car->maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $maintenanceIsActive = !$m->date_to || $m->date_to >= now();
                                            ?>
                                            <tr>
                                                <td class="text-truncate">
                                                    <a href="<?php echo e(route('maintenances.show', $m->id)); ?>"
                                                       class="text-decoration-none">
                                                        <?php echo e($m->maintenanceGarages?->name ?? ''); ?>

                                                    </a>
                                                </td>
                                                <td class="text-truncate"><?php echo e($m->maintenanceGarages?->address ?? ''); ?></td>
                                                <td class="text-truncate">
                                                    <?php if($m->maintenanceGarages?->phone1): ?>
                                                        <small class="text-muted">
                                                            Uff: <?php echo e($m->maintenanceGarages?->phone1); ?>

                                                        </small><br>
                                                    <?php endif; ?>
                                                    <?php if($m->maintenanceGarages?->phone2): ?>
                                                        <small class="text-muted">
                                                            Fax: <?php echo e($m->maintenanceGarages?->phone2); ?>

                                                        </small><br>
                                                    <?php endif; ?>
                                                    <?php if($m->maintenanceGarages?->phone3): ?>
                                                        <small class="text-muted">
                                                            Resp: <?php echo e($m->maintenanceGarages?->phone3); ?>

                                                        </small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-truncate">
                                                    <?php if($m->maintenanceGarages?->mail): ?>
                                                        <small class="text-muted">
                                                            Mail: <?php echo e($m->maintenanceGarages?->mail); ?>

                                                        </small><br>
                                                    <?php endif; ?>
                                                    <?php if($m->maintenanceGarages?->pec): ?>
                                                        <small class="text-muted">
                                                            Pec: <?php echo e($m->maintenanceGarages?->pec); ?>

                                                        </small><br>
                                                    <?php endif; ?></td>
                                                <td><?php echo e($m->maintenanceTypes?->name ?? ''); ?></td>
                                                <td><?php echo e(date('d/m/Y', strtotime($m->date_from))); ?></td>
                                                <td>
                                                    <?php if($maintenanceIsActive): ?>
                                                        <span class="badge bg-warning text-dark w-100">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    <?php endif; ?>
                                                <td><?php echo e($m->note); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="module">
        $(document).ready(() => {
            const tab = +location.search.split('tab=')[1] || 1
            $('.nav-link').removeClass('active').attr('aria-selected', false)
            $('.tab-pane').removeClass('show active')
            console.log(tab)
            switch (tab) {
                case 1:
                    $('#nav-car-tab').addClass('active').attr('aria-selected', true)
                    $('#nav-car').addClass('show active')
                    break
                case 2:
                    $('#nav-movement-tab').addClass('active').attr('aria-selected', true)
                    $('#nav-movement').addClass('show active')
                    break
                case 3:
                    $('#nav-maintenance-tab').addClass('active').attr('aria-selected', true)
                    $('#nav-maintenance').addClass('show active')
                    break
            }
        });
        $(document).on('maintenance:inserted', function (e) {
            Swal.fire({
                icon: 'success',
                title: 'Manutenzione aggiunta!',
                timer: 3000,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = '?tab=3';
            });
        })
        $(document).on('movement:inserted', function (e) {
            Swal.fire({
                icon: 'success',
                title: 'Movimento aggiunto!',
                timer: 3000,
                showConfirmButton: false
            }).then((result) => {
                window.location.href = '?tab=2';
            });
        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/car/show.blade.php ENDPATH**/ ?>