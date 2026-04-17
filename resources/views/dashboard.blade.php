<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/app/dashboard.css') }}">
    @endpush

    @slot('breadcrumb')
        <a href="{{ route('dashboard') }}" style="color: var(--af-text-dark); font-weight: 600; text-decoration: none;">Inicio</a>
    @endslot

    {{-- ── Encabezado de página ── --}}
    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Bienvenido, {{ explode(' ', Auth::user()->name)[0] }} 👋</h1>
            <p>Aquí tienes un resumen de tus automatizaciones</p>
        </div>
        <div class="af-page-header__actions">
            <a href="{{ route('automations.index') }}?new=1" class="af-btn af-btn--primary">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva automatización
            </a>
        </div>
    </div>

    {{-- ── Tarjetas de estadísticas ── --}}
    <div class="af-stats-grid">

        {{-- Total de automatizaciones --}}
        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Total</span>
                <div class="af-stat-card__icon af-stat-card__icon--primary">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value">{{ $stats['total'] ?? 0 }}</div>
            <div class="af-stat-card__footer">
                <span class="af-stat-card__trend af-stat-card__trend--up">↑ 2</span>
                este mes
            </div>
        </div>

        {{-- Activas --}}
        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Activas</span>
                <div class="af-stat-card__icon af-stat-card__icon--success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value">{{ $stats['active'] ?? 0 }}</div>
            <div class="af-stat-card__footer">
                <span style="color: var(--af-text-placeholder);">ejecutándose ahora</span>
            </div>
        </div>

        {{-- Ejecuciones --}}
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
            <div class="af-stat-card__value">{{ $stats['executions'] ?? 0 }}</div>
            <div class="af-stat-card__footer">
                <span style="color: var(--af-text-placeholder);">últimos 30 días</span>
            </div>
        </div>

        {{-- Tasa de éxito --}}
        <div class="af-stat-card">
            <div class="af-stat-card__header">
                <span class="af-stat-card__label">Éxito</span>
                <div class="af-stat-card__icon af-stat-card__icon--success">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
            <div class="af-stat-card__value">{{ $stats['success_rate'] ?? '—' }}%</div>
            <div class="af-stat-card__footer">
                <span class="af-stat-card__trend af-stat-card__trend--up">↑ 3%</span>
                vs mes anterior
            </div>
        </div>

    </div>

    {{-- ── Grid principal ── --}}
    <div class="af-dashboard-grid">

        {{-- Columna izquierda: automatizaciones recientes + actividad --}}
        <div style="display: flex; flex-direction: column; gap: 20px;">

            {{-- Automatizaciones recientes --}}
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 style="font-size: 0.95rem; font-weight: 700; color: var(--af-text-dark); margin: 0 0 2px;">
                            Automatizaciones recientes
                        </h2>
                        <p style="font-size: 0.8rem; color: var(--af-text-muted); margin: 0;">
                            Tus últimas automatizaciones creadas
                        </p>
                    </div>
                    <a href="{{ route('automations.index') }}" class="af-btn af-btn--secondary af-btn--sm">
                        Ver todas
                    </a>
                </div>

                <div class="af-card__body" style="padding-top: 0;">
                    @forelse ($recentAutomations ?? [] as $automation)
                        <div style="display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--af-border-light);">

                            {{-- Icono del trigger --}}
                            <div class="af-automation-card__trigger-icon af-automation-card__trigger-icon--{{ $automation->trigger_type ?? 'default' }}">
                                @switch($automation->trigger_type)
                                    @case('email')    📧 @break
                                    @case('whatsapp') 💬 @break
                                    @case('registro') 👤 @break
                                    @case('pago')     💳 @break
                                    @default          ⚡
                                @endswitch
                            </div>

                            <div style="flex: 1; min-width: 0;">
                                <div style="font-size: 0.875rem; font-weight: 600; color: var(--af-text-dark); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $automation->name }}
                                </div>
                                <div style="font-size: 0.775rem; color: var(--af-text-muted);">
                                    {{ ucfirst($automation->trigger_type) }} · {{ $automation->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                                <span class="af-badge-dot"></span>
                                {{ $automation->active ? 'Activa' : 'Inactiva' }}
                            </span>

                            <a href="{{ route('automations.show', $automation) }}"
                               class="af-btn af-btn--ghost af-btn--sm af-btn--icon">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="af-empty-state">
                            <div class="af-empty-state__icon">
                                <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3>Sin automatizaciones aún</h3>
                            <p>Crea tu primera automatización para empezar a ahorrar tiempo</p>
                            <a href="{{ route('automations.index') }}?new=1" class="af-btn af-btn--primary af-btn--sm">
                                Crear automatización
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Actividad reciente --}}
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 style="font-size: 0.95rem; font-weight: 700; color: var(--af-text-dark); margin: 0 0 2px;">
                            Actividad reciente
                        </h2>
                        <p style="font-size: 0.8rem; color: var(--af-text-muted); margin: 0;">
                            Últimas ejecuciones de tus flujos
                        </p>
                    </div>
                </div>
                <div class="af-card__body" style="padding-top: 8px;">
                    <div class="af-activity-list">

                        @forelse ($recentActivity ?? [] as $activity)
                            <div class="af-activity-item">
                                <div class="af-activity-icon af-activity-icon--{{ $activity['type'] ?? 'primary' }}">
                                    @if (($activity['type'] ?? '') === 'success')
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @elseif (($activity['type'] ?? '') === 'warning')
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    @else
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="af-activity-content">
                                    <div class="af-activity-content__title">{{ $activity['title'] }}</div>
                                    <div class="af-activity-content__desc">{{ $activity['description'] }}</div>
                                </div>
                                <div class="af-activity-time">{{ $activity['time'] }}</div>
                            </div>
                        @empty
                            {{-- Actividad de ejemplo cuando no hay datos --}}
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
                        @endforelse

                    </div>
                </div>
            </div>

        </div>

        {{-- Columna derecha: acciones rápidas + tipos de trigger --}}
        <div style="display: flex; flex-direction: column; gap: 20px;">

            {{-- Acciones rápidas --}}
            <div class="af-card">
                <div class="af-card__header">
                    <h2 style="font-size: 0.95rem; font-weight: 700; color: var(--af-text-dark); margin: 0;">
                        Acciones rápidas
                    </h2>
                </div>
                <div class="af-card__body">
                    <div class="af-quick-actions">

                        <a href="{{ route('automations.index') }}?new=1" class="af-quick-action">
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

                        <a href="{{ route('automations.index') }}" class="af-quick-action">
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

                        <a href="{{ route('profile.edit') }}" class="af-quick-action">
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

            {{-- Tipos de trigger disponibles --}}
            <div class="af-card">
                <div class="af-card__header">
                    <h2 style="font-size: 0.95rem; font-weight: 700; color: var(--af-text-dark); margin: 0;">
                        Tipos de trigger
                    </h2>
                </div>
                <div class="af-card__body">
                    <div style="display: flex; flex-direction: column; gap: 10px;">

                        @foreach ([
                            ['emoji' => '📧', 'label' => 'Email',      'desc' => 'Dispara al recibir un correo',  'color' => '#fef3c7', 'tc' => '#d97706'],
                            ['emoji' => '💬', 'label' => 'WhatsApp',   'desc' => 'Responde mensajes automáticos', 'color' => '#dcfce7', 'tc' => '#16a34a'],
                            ['emoji' => '👤', 'label' => 'Registro',   'desc' => 'Cuando se registra un usuario', 'color' => '#dbeafe', 'tc' => '#2563eb'],
                            ['emoji' => '💳', 'label' => 'Pago',       'desc' => 'Al completar un pago',          'color' => '#f3e8ff', 'tc' => '#9333ea'],
                        ] as $trigger)
                            <div style="display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: var(--af-radius); background: var(--af-bg);">
                                <div style="width: 34px; height: 34px; border-radius: 8px; background: {{ $trigger['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0;">
                                    {{ $trigger['emoji'] }}
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--af-text-dark);">{{ $trigger['label'] }}</div>
                                    <div style="font-size: 0.75rem; color: var(--af-text-muted);">{{ $trigger['desc'] }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
