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
        <a href="<?php echo e(route('dashboard')); ?>" class="af-breadcrumb-link">Inicio</a>
        <span>›</span>
        <a href="<?php echo e(route('automations.index')); ?>" class="af-breadcrumb-link">Automatizaciones</a>
        <span>›</span>
        <strong><?php echo e(Str::limit($automation->name, 32)); ?></strong>
    <?php $__env->endSlot(); ?>

    
    <div class="af-detail-header">
        <div class="af-detail-header__left">

            <div class="af-automation-card__trigger-icon af-trigger-icon--lg af-automation-card__trigger-icon--<?php echo e($automation->trigger_type); ?>">
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

            <div>
                <h1 class="af-detail-header__title"><?php echo e($automation->name); ?></h1>
                <div class="af-detail-header__meta">
                    <span class="af-badge <?php echo e($automation->active ? 'af-badge--success' : 'af-badge--muted'); ?>">
                        <span class="af-badge-dot"></span>
                        <?php echo e($automation->active ? 'Activa' : 'Inactiva'); ?>

                    </span>
                    <span class="af-badge af-badge--primary"><?php echo e(ucfirst($automation->trigger_type)); ?></span>
                    <span class="af-detail-header__date">Creada <?php echo e($automation->created_at->diffForHumans()); ?></span>
                </div>
                <?php if($automation->description): ?>
                    <p class="af-detail-header__desc"><?php echo e($automation->description); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="af-detail-header__actions">
            <form method="POST" action="<?php echo e(route('automations.toggle', $automation)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <button type="submit" class="af-btn <?php echo e($automation->active ? 'af-btn--secondary' : 'af-btn--primary'); ?> af-btn--sm">
                    <?php if($automation->active): ?>
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pausar
                    <?php else: ?>
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Activar
                    <?php endif; ?>
                </button>
            </form>

            <a href="<?php echo e(route('automations.edit', $automation)); ?>" class="af-btn af-btn--secondary af-btn--sm">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
        </div>
    </div>

    
    <div class="af-detail-grid">

        
        <div>
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 class="af-card__title">Historial de ejecuciones</h2>
                        <p class="af-card__subtitle">Últimas <?php echo e($executions->count() ?? 0); ?> ejecuciones registradas</p>
                    </div>
                    <span class="af-badge af-badge--primary"><?php echo e($executions->total() ?? 0); ?> total</span>
                </div>

                <div class="af-card__body af-card__body--px-only">
                    <?php $__empty_1 = true; $__currentLoopData = $executions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $execution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="af-execution-item">
                            <span class="af-execution-status-dot af-execution-status-dot--<?php echo e($execution->status); ?>"></span>
                            <div class="af-execution-item__info">
                                <div class="af-execution-item__title">
                                    <?php switch($execution->status):
                                        case ('success'): ?> Ejecución exitosa <?php break; ?>
                                        <?php case ('error'): ?>   Error en ejecución <?php break; ?>
                                        <?php case ('pending'): ?> En cola <?php break; ?>
                                        <?php default: ?>         <?php echo e(ucfirst($execution->status)); ?>

                                    <?php endswitch; ?>
                                </div>
                                <?php if($execution->message): ?>
                                    <div class="af-execution-item__message"><?php echo e($execution->message); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="af-execution-item__time">
                                <div class="af-execution-item__time-text">
                                    <?php echo e($execution->created_at->format('d M, H:i')); ?>

                                </div>
                                <?php if($execution->duration_ms): ?>
                                    <div class="af-execution-item__duration"><?php echo e($execution->duration_ms); ?>ms</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="af-empty-state af-empty-state--compact">
                            <div class="af-empty-state__icon">
                                <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3>Sin ejecuciones aún</h3>
                            <p>Esta automatización no ha sido disparada todavía</p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(isset($executions) && $executions->hasPages()): ?>
                    <div class="af-card__footer"><?php echo e($executions->links()); ?></div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="af-detail-col">

            
            <div class="af-card">
                <div class="af-card__header">
                    <h2 class="af-card__title">Detalles</h2>
                </div>
                <div class="af-card__body">
                    <dl class="af-details-list">
                        <div>
                            <dt>Trigger</dt>
                            <dd>
                                <?php switch($automation->trigger_type):
                                    case ('email'): ?>    📧 Email <?php break; ?>
                                    <?php case ('whatsapp'): ?> 💬 WhatsApp <?php break; ?>
                                    <?php case ('registro'): ?> 👤 Registro <?php break; ?>
                                    <?php case ('pago'): ?>     💳 Pago <?php break; ?>
                                    <?php case ('webhook'): ?>  🔗 Webhook <?php break; ?>
                                    <?php case ('schedule'): ?> ⏰ Programado <?php break; ?>
                                    <?php default: ?>          ⚡ <?php echo e(ucfirst($automation->trigger_type)); ?>

                                <?php endswitch; ?>
                            </dd>
                        </div>
                        <div>
                            <dt>Estado</dt>
                            <dd class="af-details-list__badge">
                                <span class="af-badge <?php echo e($automation->active ? 'af-badge--success' : 'af-badge--muted'); ?>">
                                    <span class="af-badge-dot"></span>
                                    <?php echo e($automation->active ? 'Activa' : 'Inactiva'); ?>

                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt>Creada</dt>
                            <dd><?php echo e($automation->created_at->format('d \d\e M\., Y')); ?></dd>
                        </div>
                        <div>
                            <dt>Última modificación</dt>
                            <dd><?php echo e($automation->updated_at->diffForHumans()); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>

            
            <div class="af-card af-card--danger">
                <div class="af-card__header af-card__header--danger">
                    <h2 class="af-card__title--danger">Zona de peligro</h2>
                </div>
                <div class="af-card__body">
                    <p class="af-card__desc">
                        Eliminar esta automatización es permanente. Se borrarán también todos sus registros de ejecución.
                    </p>
                    <form id="af-destroy-form"
                          method="POST"
                          action="<?php echo e(route('automations.destroy', $automation)); ?>">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="button"
                                class="af-btn af-btn--danger af-btn--sm af-btn--full"
                                id="af-destroy-btn"
                                data-name="<?php echo e(addslashes($automation->name)); ?>">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar automatización
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('js/app/automations.js')); ?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btn  = document.getElementById('af-destroy-btn');
                const form = document.getElementById('af-destroy-form');
                if (btn && form) {
                    btn.addEventListener('click', function () {
                        Swal.fire({
                            title             : '¿Eliminar automatización?',
                            html              : `<strong>«${btn.dataset.name}»</strong> será eliminada permanentemente.`,
                            icon              : 'warning',
                            showCancelButton  : true,
                            confirmButtonText : 'Sí, eliminar',
                            cancelButtonText  : 'Cancelar',
                            reverseButtons    : true,
                            focusCancel       : true,
                            customClass: { popup: 'af-swal-popup', confirmButton: 'af-swal-confirm', cancelButton: 'af-swal-cancel' },
                            buttonsStyling    : false,
                        }).then(result => { if (result.isConfirmed) form.submit(); });
                    });
                }
            });
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
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/automations/show.blade.php ENDPATH**/ ?>