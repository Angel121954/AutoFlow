<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/app/automations.css')); ?>">
    <?php $__env->stopPush(); ?>

    <?php $__env->slot('breadcrumb'); ?>
        <a href="<?php echo e(route('dashboard')); ?>" style="text-decoration:none; color:var(--af-text-muted);">Inicio</a>
        <span>›</span>
        <strong>Automatizaciones</strong>
    <?php $__env->endSlot(); ?>

    
    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Mis Automatizaciones</h1>
            <p>Gestiona y monitorea todos tus flujos automáticos</p>
        </div>
        <div class="af-page-header__actions">
            <button class="af-btn af-btn--primary" onclick="openCreateModal()">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva automatización
            </button>
        </div>
    </div>

    
    <div class="af-filters">
        <div class="af-search-box">
            <svg class="af-search-box__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="search"
                   placeholder="Buscar automatización..."
                   class="af-input"
                   id="af-search-input"
                   oninput="filterAutomations()"
                   style="padding-left:40px;"/>
        </div>
        <div class="af-filter-pills">
            <button class="af-filter-pill af-filter-pill--active" onclick="setFilter('all', this)">Todas</button>
            <button class="af-filter-pill" onclick="setFilter('active', this)">Activas</button>
            <button class="af-filter-pill" onclick="setFilter('inactive', this)">Inactivas</button>
        </div>
        <select class="af-input af-select" style="width:auto; min-width:160px;" onchange="filterByTrigger(this.value)">
            <option value="">Todos los triggers</option>
            <option value="email">📧 Email</option>
            <option value="whatsapp">💬 WhatsApp</option>
            <option value="registro">👤 Registro</option>
            <option value="pago">💳 Pago</option>
            <option value="webhook">🔗 Webhook</option>
            <option value="schedule">⏰ Programado</option>
        </select>
    </div>

    
    <?php if($automations->isEmpty()): ?>
        <div class="af-empty-page">
            <div class="af-empty-page__icon">
                <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3>Sin automatizaciones aún</h3>
            <p>Crea tu primera automatización y empieza a ahorrar tiempo en tus procesos de negocio de forma inteligente.</p>
        </div>
    <?php else: ?>
        <div class="af-automations-grid" id="af-automations-grid">
            <?php $__currentLoopData = $automations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $automation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="af-automation-card"
                 data-name="<?php echo e(strtolower($automation->name)); ?>"
                 data-status="<?php echo e($automation->active ? 'active' : 'inactive'); ?>"
                 data-trigger="<?php echo e($automation->trigger_type); ?>">

                <div class="af-automation-card__header">
                    <div class="af-automation-card__title-row">
                        <div class="af-automation-card__trigger-icon af-automation-card__trigger-icon--<?php echo e($automation->trigger_type); ?>">
                            <?php switch($automation->trigger_type):
                                case ('email'): ?>    📧 <?php break; ?>
                                <?php case ('whatsapp'): ?> 💬 <?php break; ?>
                                <?php case ('registro'): ?> 👤 <?php break; ?>
                                <?php case ('pago'): ?>     💳 <?php break; ?>
                                <?php case ('webhook'): ?>  🔗 <?php break; ?>
                                <?php case ('schedule'): ?> ⏰ <?php break; ?>
                                <?php default: ?>          ⚡
                            <?php endswitch; ?>
                        </div>
                        <div class="af-automation-card__info">
                            <div class="af-automation-card__name" title="<?php echo e($automation->name); ?>">
                                <?php echo e($automation->name); ?>

                            </div>
                            <?php if($automation->description): ?>
                                <div class="af-automation-card__desc"><?php echo e($automation->description); ?></div>
                            <?php else: ?>
                                <div class="af-automation-card__desc af-automation-card__desc--empty">
                                    Sin descripción
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="af-automation-card__toggle">
                        <form method="POST" action="<?php echo e(route('automations.toggle', $automation)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <label class="af-toggle" title="<?php echo e($automation->active ? 'Desactivar' : 'Activar'); ?>">
                                <input type="checkbox" <?php echo e($automation->active ? 'checked' : ''); ?>

                                       onchange="this.closest('form').submit()">
                                <span class="af-toggle-track"><span class="af-toggle-thumb"></span></span>
                            </label>
                        </form>
                    </div>
                </div>

                
                <div class="af-automation-card__footer">
                    <div class="af-automation-card__meta">
                        <span class="af-badge <?php echo e($automation->active ? 'af-badge--success' : 'af-badge--muted'); ?>">
                            <span class="af-badge-dot"></span>
                            <?php echo e($automation->active ? 'Activa' : 'Inactiva'); ?>

                        </span>
                        <span class="af-badge af-badge--primary"><?php echo e(ucfirst($automation->trigger_type)); ?></span>
                    </div>

                    <div class="af-automation-card__actions">

                        
                        <a href="<?php echo e(route('automations.show', $automation)); ?>"
                           class="af-automation-card__action-btn" title="Ver detalle">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>

                        
                        <button class="af-automation-card__action-btn" title="Editar"
                                onclick="openEditModal({
                                    id:           <?php echo e($automation->id); ?>,
                                    name:         <?php echo e(json_encode($automation->name)); ?>,
                                    description:  <?php echo e(json_encode($automation->description ?? '')); ?>,
                                    trigger_type: <?php echo e(json_encode($automation->trigger_type)); ?>,
                                    active:       <?php echo e($automation->active ? 'true' : 'false'); ?>

                                })">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>

                        
                        <form id="delete-form-<?php echo e($automation->id); ?>"
                              method="POST"
                              action="<?php echo e(route('automations.destroy', $automation)); ?>"
                              style="display:none;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        </form>

                        
                        <button class="af-automation-card__action-btn af-automation-card__action-btn--danger"
                                title="Eliminar"
                                onclick="confirmDelete(<?php echo e($automation->id); ?>, <?php echo e(json_encode($automation->name)); ?>)">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>

                    </div>
                </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($automations->hasPages()): ?>
            <div style="margin-top:28px;"><?php echo e($automations->links()); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalfa2abbfbca1b892d411755d8e97ffc72 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa2abbfbca1b892d411755d8e97ffc72 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.automation-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('automation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa2abbfbca1b892d411755d8e97ffc72)): ?>
<?php $attributes = $__attributesOriginalfa2abbfbca1b892d411755d8e97ffc72; ?>
<?php unset($__attributesOriginalfa2abbfbca1b892d411755d8e97ffc72); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa2abbfbca1b892d411755d8e97ffc72)): ?>
<?php $component = $__componentOriginalfa2abbfbca1b892d411755d8e97ffc72; ?>
<?php unset($__componentOriginalfa2abbfbca1b892d411755d8e97ffc72); ?>
<?php endif; ?>

    <?php $__env->startPush('scripts'); ?>
        
        <script>
            window.AfRoutes = {
                automationsStore: '<?php echo e(route('automations.store')); ?>'
            };
        </script>

        
        <script src="<?php echo e(asset('js/app/automations.js')); ?>"></script>

        
        <script>
            <?php if($errors->any()): ?>
                document.addEventListener('DOMContentLoaded', () => {
                    <?php if(old('editing_id')): ?>
                        openEditModal({
                            id:           <?php echo e((int) old('editing_id')); ?>,
                            name:         <?php echo json_encode(old('name', '')); ?>,
                            description:  <?php echo json_encode(old('description', '')); ?>,
                            trigger_type: <?php echo json_encode(old('trigger_type', '')); ?>,
                            active:       <?php echo e(old('active') ? 'true' : 'false'); ?>,
                        });
                    <?php else: ?>
                        openCreateModal();
                        document.getElementById('modal-name').value        = <?php echo json_encode(old('name', '')); ?>;
                        document.getElementById('modal-description').value = <?php echo json_encode(old('description', '')); ?>;
                        <?php if(old('trigger_type')): ?>
                            setTriggerSelection(<?php echo json_encode(old('trigger_type')); ?>);
                        <?php endif; ?>
                    <?php endif; ?>
                });
            <?php elseif(request()->query('new')): ?>
                document.addEventListener('DOMContentLoaded', () => openCreateModal());
            <?php elseif(request()->query('edit')): ?>
                document.addEventListener('DOMContentLoaded', () => {
                    <?php
                        $editId   = (int) request()->query('edit');
                        $editAuto = $automations->firstWhere('id', $editId);
                    ?>
                    <?php if($editAuto): ?>
                        openEditModal({
                            id:           <?php echo e($editAuto->id); ?>,
                            name:         <?php echo json_encode($editAuto->name); ?>,
                            description:  <?php echo json_encode($editAuto->description ?? ''); ?>,
                            trigger_type: <?php echo json_encode($editAuto->trigger_type); ?>,
                            active:       <?php echo e($editAuto->active ? 'true' : 'false'); ?>,
                        });
                    <?php endif; ?>
                });
            <?php endif; ?>
        </script>
    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/automations/index.blade.php ENDPATH**/ ?>