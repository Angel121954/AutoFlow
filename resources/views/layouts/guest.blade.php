<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'AutoFlow') }}</title>

    {{-- Fuente --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Design system + Auth CSS --}}
    <link rel="stylesheet" href="{{ asset('css/autoflow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">

    {{-- Tailwind / Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Hojas adicionales por vista --}}
    @stack('styles')
</head>

<body>
    <div class="af-auth-screen">

        {{-- ── Panel izquierdo decorativo ── --}}
        <div class="af-auth-panel">
            <div class="af-auth-panel__brand">
                <span class="af-logo-icon">
                    <span class="af-logo-sq af-logo-sq-1 af-logo-sq--white-1"></span>
                    <span class="af-logo-sq af-logo-sq-2 af-logo-sq--white-2"></span>
                    <span class="af-logo-sq af-logo-sq-3 af-logo-sq--white-3"></span>
                </span>
                <span class="af-auth-panel__brand-text">AutoFlow</span>
            </div>

            <div class="af-auth-panel__headline">
                <h2>Automatiza.<br>Escala.<br>Crece.</h2>
                <p>Conecta tus procesos de negocio y elimina el trabajo manual con automatizaciones inteligentes en minutos.</p>
            </div>

            <div class="af-auth-panel__features">
                <div class="af-auth-panel__feature">
                    <div class="af-auth-panel__feature-icon">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.9)" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    Automatiza flujos en minutos, sin código
                </div>
                <div class="af-auth-panel__feature">
                    <div class="af-auth-panel__feature-icon">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.9)" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    Notificaciones en tiempo real
                </div>
                <div class="af-auth-panel__feature">
                    <div class="af-auth-panel__feature-icon">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.9)" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    Métricas y reportes detallados
                </div>
            </div>
        </div>

        {{-- ── Panel derecho: formulario ── --}}
        <div class="af-auth-form-area">
            <div class="af-auth-card">

                {{-- Logo móvil --}}
                <div class="af-auth-logo">
                    <span class="af-logo-icon">
                        <span class="af-logo-sq af-logo-sq-1"></span>
                        <span class="af-logo-sq af-logo-sq-2"></span>
                        <span class="af-logo-sq af-logo-sq-3"></span>
                    </span>
                    <span class="af-auth-logo-text">AutoFlow</span>
                </div>

                {{-- Alertas de sesión --}}
                @if (session('status'))
                    <div class="af-alert af-alert--success">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="af-alert af-alert--danger">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </div>

    </div>

    @stack('scripts')
</body>

</html>
