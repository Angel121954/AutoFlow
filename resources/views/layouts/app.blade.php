<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'AutoFlow') }}</title>

    {{-- Favicon --}}
    <link rel="icon"             type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon"    type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon"                  href="{{ asset('favicon.png') }}">

    {{-- Fuente --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Design system CSS --}}
    <link rel="stylesheet" href="{{ asset('css/autoflow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app/layout.css') }}">

    {{-- Tailwind/Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Hojas adicionales por vista --}}
    @stack('styles')

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* ── AutoFlow SweetAlert2 theme ── */
        .af-swal-popup {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 4px 6px rgba(0,0,0,.04), 0 24px 60px rgba(0,0,0,.12) !important;
            color: #1e293b !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .af-swal-popup .swal2-title {
            color: #0f172a !important;
            font-size: 1.1rem !important;
            font-weight: 700 !important;
        }
        .af-swal-popup .swal2-html-container {
            color: #64748b !important;
            font-size: 0.875rem !important;
            line-height: 1.6 !important;
        }
        .af-swal-popup .swal2-icon { border-color: transparent !important; }
        .af-swal-popup .swal2-icon.swal2-warning { color: #d97706; border-color: #fcd34d !important; }
        .af-swal-popup .swal2-icon.swal2-error   { color: #dc2626; border-color: #fca5a5 !important; }
        .af-swal-popup .swal2-icon.swal2-success { border-color: #86efac !important; }
        .af-swal-popup .swal2-icon.swal2-success [class^='swal2-success-line'] { background: #16a34a !important; }
        .af-swal-popup .swal2-icon.swal2-success .swal2-success-ring { border-color: rgba(22,163,74,.25) !important; }
        .af-swal-popup .swal2-actions { gap: 10px !important; }
        .af-swal-popup .swal2-timer-progress-bar { background: #2563eb !important; }

        /* Botones del popup */
        .af-swal-confirm {
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background: #dc2626;
            color: #fff;
            transition: opacity .15s;
        }
        .af-swal-confirm:hover { opacity: .88; }
        .af-swal-cancel {
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            background: #fff;
            color: #64748b;
            transition: background .15s;
        }
        .af-swal-cancel:hover { background: #f8fafc; }

        /* Toast */
        .af-swal-toast.swal2-popup {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 24px rgba(0,0,0,.1) !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .af-swal-toast .swal2-title {
            color: #0f172a !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
        }
        .af-swal-toast .swal2-timer-progress-bar {
            background: #2563eb !important;
        }
    </style>
</head>

<body>
<div class="af-app">

    {{-- ── Sidebar ── --}}
    <aside class="af-sidebar" id="af-sidebar">

        {{-- Logo / Marca --}}
        <a href="{{ route('dashboard') }}" class="af-sidebar__brand">
            <span class="af-logo-icon">
                <span class="af-logo-sq af-logo-sq-1"></span>
                <span class="af-logo-sq af-logo-sq-2"></span>
                <span class="af-logo-sq af-logo-sq-3"></span>
            </span>
            <span class="af-sidebar__brand-text">AutoFlow</span>
        </a>

        {{-- Navegación principal --}}
        <nav class="af-sidebar__nav" aria-label="Navegación principal">

            {{-- General --}}
            <span class="af-sidebar__section-label">General</span>

            <a href="{{ route('dashboard') }}"
               class="af-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
                <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Inicio
            </a>

            {{-- Automatizaciones --}}
            <span class="af-sidebar__section-label" style="margin-top: 8px;">Automatizaciones</span>

            <a href="{{ route('automations.index') }}"
               class="af-nav-item {{ request()->routeIs('automations.*') ? 'active' : '' }}">
                <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Mis Automatizaciones
            </a>

            <a href="{{ route('automations.index') }}?new=1"
               onclick="
                   if (typeof openCreateModal === 'function') {
                       event.preventDefault();
                       openCreateModal();
                   }
               "
               class="af-nav-item {{ request()->routeIs('automations.create') ? 'active' : '' }}">
                <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Automatización
            </a>

            {{-- Configuración --}}
            <span class="af-sidebar__section-label" style="margin-top: 8px;">Cuenta</span>

            <a href="{{ route('profile.edit') }}"
               class="af-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg class="af-nav-item__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Mi Perfil
            </a>

        </nav>

        {{-- Usuario en el pie del sidebar --}}
        <div class="af-sidebar__footer">
            <div class="af-user-pill" id="af-user-dropdown-trigger"
                 onclick="document.getElementById('af-user-dropdown').classList.toggle('open')">
                <div class="af-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="af-user-info">
                    <div class="af-user-info__name">{{ Auth::user()->name }}</div>
                    <div class="af-user-info__email">{{ Auth::user()->email }}</div>
                </div>
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            {{-- Dropdown del usuario --}}
            <div class="af-dropdown__menu" id="af-user-dropdown" style="bottom: calc(100% + 8px); top: auto; width: 100%;">
                <a href="{{ route('profile.edit') }}" class="af-dropdown__menu-item">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Mi Perfil
                </a>
                <div class="af-dropdown__divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="af-dropdown__menu-item af-dropdown__menu-item--danger" style="width:100%;">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- Overlay mobile --}}
    <div class="af-overlay" id="af-overlay" onclick="closeSidebar()"></div>

    {{-- ── Área principal ── --}}
    <main class="af-main">

        {{-- Topbar --}}
        <header class="af-topbar">

            {{-- Hamburger (mobile) --}}
            <button class="af-sidebar-toggle" onclick="openSidebar()" aria-label="Abrir menú">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            @isset($breadcrumb)
                <nav class="af-topbar__breadcrumb" aria-label="Breadcrumb">
                    {{ $breadcrumb }}
                </nav>
            @endisset

            <div class="af-topbar__spacer"></div>

            {{-- Acciones del topbar --}}
            <div class="af-topbar__actions">

                {{-- Botón de nueva automatización --}}
                <a href="{{ route('automations.create') }}"
                   class="af-btn af-btn--primary af-btn--sm"
                   style="display: none;"
                   id="af-topbar-new-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva
                </a>

                {{-- Notificaciones --}}
                <button class="af-topbar__icon-btn" aria-label="Notificaciones">
                    <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="af-notif-dot"></span>
                </button>

            </div>
        </header>

        {{-- Contenido de la página --}}
        <div class="af-content">

            {{-- Alertas flash --}}
            @if (session('success'))
                <div class="af-alert af-alert--success" style="margin-bottom: 20px;" role="alert">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="af-alert af-alert--danger" style="margin-bottom: 20px;" role="alert">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </div>

    </main>

</div>

{{-- ── Scripts ── --}}
<script>
    // Sidebar mobile
    function openSidebar() {
        document.getElementById('af-sidebar').classList.add('open');
        document.getElementById('af-overlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('af-sidebar').classList.remove('open');
        document.getElementById('af-overlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    // Cerrar dropdown al clicar fuera
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('af-user-dropdown');
        const trigger  = document.getElementById('af-user-dropdown-trigger');
        if (dropdown && !trigger.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });
</script>

@stack('scripts')

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    /* ── Flash toasts globales ── */
    const AfToast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        customClass: { popup: 'af-swal-toast' },
    });
    @if(session('success'))
        AfToast.fire({ icon: 'success', title: {!! json_encode(session('success')) !!} });
    @endif
    @if(session('error'))
        AfToast.fire({ icon: 'error', title: {!! json_encode(session('error')) !!} });
    @endif
</script>
</body>
</html>
