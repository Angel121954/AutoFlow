<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'AutoFlow')); ?></title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/autoflow.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app/layout.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app/swal-theme.css')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <meta name="flash-success" content="<?php echo e(session('success')); ?>">
    <meta name="flash-error"   content="<?php echo e(session('error')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <div class="af-app">

        
        <aside class="af-sidebar" id="af-sidebar">

            
            <a href="<?php echo e(route('dashboard')); ?>" class="af-sidebar__brand">
                <span class="af-logo-icon">
                    <span class="af-logo-sq af-logo-sq-1"></span>
                    <span class="af-logo-sq af-logo-sq-2"></span>
                    <span class="af-logo-sq af-logo-sq-3"></span>
                </span>
                <span class="af-sidebar__brand-text">AutoFlow</span>
            </a>

            
            <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

            
            <div class="af-sidebar__footer">

                
                <div class="af-user-pill"
                     id="af-user-pill"
                     role="button"
                     tabindex="0"
                     aria-haspopup="true"
                     aria-expanded="false"
                     aria-controls="af-user-dropdown">
                    <div class="af-avatar">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                    </div>
                    <div class="af-user-info">
                        <div class="af-user-info__name"><?php echo e(Auth::user()->name); ?></div>
                        <div class="af-user-info__email"><?php echo e(Auth::user()->email); ?></div>
                    </div>
                    <svg class="af-user-pill__chevron" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                
                <div class="af-user-dropdown" id="af-user-dropdown" role="menu">

                    
                    <div class="af-user-dropdown__header">
                        <div class="af-user-dropdown__avatar" aria-hidden="true">
                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                        </div>
                        <div class="af-user-dropdown__info">
                            <div class="af-user-dropdown__name"><?php echo e(Auth::user()->name); ?></div>
                            <div class="af-user-dropdown__email"><?php echo e(Auth::user()->email); ?></div>
                        </div>
                    </div>

                    
                    <div class="af-user-dropdown__body">

                        <a href="<?php echo e(route('profile.edit')); ?>"
                           class="af-user-dropdown__item"
                           role="menuitem">
                            <span class="af-user-dropdown__item-icon" aria-hidden="true">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            Mi Perfil
                        </a>

                        <div class="af-user-dropdown__divider" role="separator"></div>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                    class="af-user-dropdown__item af-user-dropdown__item--danger"
                                    role="menuitem">
                                <span class="af-user-dropdown__item-icon" aria-hidden="true">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </span>
                                Cerrar sesión
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </aside>

        
        <div class="af-overlay" id="af-overlay"></div>

        
        <main class="af-main">

            
            <header class="af-topbar">
                <button class="af-sidebar-toggle" id="af-sidebar-toggle" aria-label="Abrir menú">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <?php if(isset($breadcrumb)): ?>
                    <nav class="af-topbar__breadcrumb" aria-label="Breadcrumb">
                        <?php echo e($breadcrumb); ?>

                    </nav>
                <?php endif; ?>

                <div class="af-topbar__spacer"></div>

                <div class="af-topbar__actions">
                    <a href="<?php echo e(route('automations.create')); ?>"
                       class="af-btn af-btn--primary af-btn--sm af-hidden"
                       id="af-topbar-new-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nueva
                    </a>
                    <button class="af-topbar__icon-btn" aria-label="Notificaciones">
                        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="af-notif-dot"></span>
                    </button>
                </div>
            </header>

            
            <div class="af-content">

                <?php if(session('success')): ?>
                    <div class="af-alert af-alert--success" role="alert">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="af-alert af-alert--danger" role="alert">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo e($slot); ?>

            </div>

        </main>
    </div>

    
    <script src="<?php echo e(asset('js/app/layout.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('js/app/swal-flash.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/layouts/app.blade.php ENDPATH**/ ?>