
<nav class="af-sidebar__nav" aria-label="Navegación principal">

    <span class="af-sidebar__section-label">General</span>

    <a href="<?php echo e(route('dashboard')); ?>"
       class="af-nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
       aria-current="<?php echo e(request()->routeIs('dashboard') ? 'page' : 'false'); ?>">
        <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Inicio
    </a>

    <span class="af-sidebar__section-label">Automatizaciones</span>

    <a href="<?php echo e(route('automations.index')); ?>"
       class="af-nav-item <?php echo e(request()->routeIs('automations.*') ? 'active' : ''); ?>">
        <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
        Mis Automatizaciones
    </a>

    
    <a href="<?php echo e(route('automations.index')); ?>"
       class="af-nav-item <?php echo e(request()->routeIs('automations.create') ? 'active' : ''); ?>"
       id="af-nav-new-automation">
        <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Nueva Automatización
    </a>

    <span class="af-sidebar__section-label">Cuenta</span>

    <a href="<?php echo e(route('profile.edit')); ?>"
       class="af-nav-item <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
        <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        Mi Perfil
    </a>

</nav>
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/components/nav-link.blade.php ENDPATH**/ ?>