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
        <link rel="stylesheet" href="<?php echo e(asset('css/app/dashboard.css')); ?>">
    <?php $__env->stopPush(); ?>

    <?php $__env->slot('breadcrumb'); ?>
        <a href="<?php echo e(route('dashboard')); ?>" class="af-breadcrumb-link--active">Inicio</a>
    <?php $__env->endSlot(); ?>

    
    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Bienvenido, <?php echo e(explode(' ', Auth::user()->name)[0]); ?> 👋</h1>
            <p>Aquí tienes un resumen de tus automatizaciones</p>
        </div>
        <div class="af-page-header__actions">
            <a href="<?php echo e(route('automations.index')); ?>?new=1" class="af-btn af-btn--primary">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva automatización
            </a>
        </div>
    </div>

    
    <div class="af-stats-grid">

        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Total</span>
                <div class="af-stat-card__icon af-stat-card__icon--primary">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value"><?php echo e($stats['total'] ?? 0); ?></div>
            <div class="af-stat-card__footer">
                <span class="af-stat-card__trend af-stat-card__trend--up">↑ 2</span>
                este mes
            </div>
        </div>

        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Activas</span>
                <div class="af-stat-card__icon af-stat-card__icon--success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value"><?php echo e($stats['active'] ?? 0); ?></div>
            <div class="af-stat-card__footer">
                <span class="af-text-placeholder">ejecutándose ahora</span>
            </div>
        </div>

        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Ejecuciones</span>
                <div class="af-stat-card__icon af-stat-card__icon--warning">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value"><?php echo e($stats['executions'] ?? 0); ?></div>
            <div class="af-stat-card__footer">
                <span class="af-text-placeholder">últimos 30 días</span>
            </div>
        </div>

        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Éxito</span>
                <div class="af-stat-card__icon af-stat-card__icon--success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value"><?php echo e($stats['success_rate'] ?? '—'); ?>%</div>
            <div class="af-stat-card__footer">
                <span class="af-stat-card__trend af-stat-card__trend--up">↑ 3%</span>
                vs mes anterior
            </div>
        </div>

    </div>

    
    <div class="af-dashboard-grid">

        
        <div class="af-dashboard-col">

            
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 class="af-card__title">Automatizaciones recientes</h2>
                        <p class="af-card__subtitle">Tus últimas automatizaciones creadas</p>
                    </div>
                    <a href="<?php echo e(route('automations.index')); ?>" class="af-btn af-btn--secondary af-btn--sm">
                        Ver todas
                    </a>
                </div>

                <div class="af-card__body af-card__body--no-pt">
                    <?php $__empty_1 = true; $__currentLoopData = $recentAutomations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $automation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="af-recent-item">
                            <div class="af-automation-card__trigger-icon af-automation-card__trigger-icon--<?php echo e($automation->trigger_type ?? 'default'); ?>">
                                <?php switch($automation->trigger_type):
                                    case ('email'): ?>    📧 <?php break; ?>
                                    <?php case ('whatsapp'): ?> 💬 <?php break; ?>
                                    <?php case ('registro'): ?> 👤 <?php break; ?>
                                    <?php case ('pago'): ?>     💳 <?php break; ?>
                                    <?php default: ?>          ⚡
                                <?php endswitch; ?>
                            </div>
                            <div class="af-recent-item__info">
                                <div class="af-recent-item__name"><?php echo e($automation->name); ?></div>
                                <div class="af-recent-item__meta">
                                    <?php echo e(ucfirst($automation->trigger_type)); ?> · <?php echo e($automation->created_at->diffForHumans()); ?>

                                </div>
                            </div>
                            <span class="af-badge <?php echo e($automation->active ? 'af-badge--success' : 'af-badge--muted'); ?>">
                                <span class="af-badge-dot"></span>
                                <?php echo e($automation->active ? 'Activa' : 'Inactiva'); ?>

                            </span>
                            <a href="<?php echo e(route('automations.show', $automation)); ?>" class="af-btn af-btn--ghost af-btn--sm af-btn--icon">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="af-empty-state">
                            <div class="af-empty-state__icon">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3>Sin automatizaciones aún</h3>
                            <p>Crea tu primera automatización para empezar a ahorrar tiempo</p>
                            <a href="<?php echo e(route('automations.index')); ?>?new=1" class="af-btn af-btn--primary af-btn--sm">
                                Crear automatización
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 class="af-card__title">Actividad reciente</h2>
                        <p class="af-card__subtitle">Últimas ejecuciones de tus flujos</p>
                    </div>
                </div>
                <div class="af-card__body af-card__body--pt-sm">
                    <div class="af-activity-list">
                        <?php $__empty_1 = true; $__currentLoopData = $recentActivity ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="af-activity-item">
                                <div class="af-activity-icon af-activity-icon--<?php echo e($activity['type'] ?? 'primary'); ?>">
                                    <?php if(($activity['type'] ?? '') === 'success'): ?>
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php elseif(($activity['type'] ?? '') === 'warning'): ?>
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="af-activity-content">
                                    <div class="af-activity-content__title"><?php echo e($activity['title']); ?></div>
                                    <div class="af-activity-content__desc"><?php echo e($activity['description']); ?></div>
                                </div>
                                <div class="af-activity-time"><?php echo e($activity['time']); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="af-activity-item">
                                <div class="af-activity-icon af-activity-icon--success">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="af-activity-content">
                                    <div class="af-activity-content__title">Cuenta creada</div>
                                    <div class="af-activity-content__desc">Bienvenido a AutoFlow. ¡Crea tu primera automatización!</div>
                                </div>
                                <div class="af-activity-time">Ahora</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="af-dashboard-col">

            
            <div class="af-card">
                <div class="af-card__header">
                    <h2 class="af-card__title">Acciones rápidas</h2>
                </div>
                <div class="af-card__body">
                    <div class="af-quick-actions">

                        <a href="<?php echo e(route('automations.index')); ?>?new=1" class="af-quick-action">
                            <div class="af-quick-action__icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <span class="af-quick-action__text">Nueva automatización</span>
                            <svg class="af-quick-action__arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="<?php echo e(route('automations.index')); ?>" class="af-quick-action">
                            <div class="af-quick-action__icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </div>
                            <span class="af-quick-action__text">Ver todas</span>
                            <svg class="af-quick-action__arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="<?php echo e(route('profile.edit')); ?>" class="af-quick-action">
                            <div class="af-quick-action__icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="af-quick-action__text">Editar perfil</span>
                            <svg class="af-quick-action__arrow" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>

            
            <div class="af-card">
                <div class="af-card__header">
                    <h2 class="af-card__title">Tipos de trigger</h2>
                </div>
                <div class="af-card__body">
                    <div class="af-trigger-list">
                        <?php $__currentLoopData = [
                            ['type' => 'email',    'emoji' => '📧', 'label' => 'Email',    'desc' => 'Dispara al recibir un correo'],
                            ['type' => 'whatsapp', 'emoji' => '💬', 'label' => 'WhatsApp', 'desc' => 'Responde mensajes automáticos'],
                            ['type' => 'registro', 'emoji' => '👤', 'label' => 'Registro', 'desc' => 'Cuando se registra un usuario'],
                            ['type' => 'pago',     'emoji' => '💳', 'label' => 'Pago',     'desc' => 'Al completar un pago'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trigger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="af-trigger-item">
                                <div class="af-trigger-item__icon af-trigger-item__icon--<?php echo e($trigger['type']); ?>">
                                    <?php echo e($trigger['emoji']); ?>

                                </div>
                                <div class="af-trigger-item__info">
                                    <div class="af-trigger-item__label"><?php echo e($trigger['label']); ?></div>
                                    <div class="af-trigger-item__desc"><?php echo e($trigger['desc']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/dashboard.blade.php ENDPATH**/ ?>