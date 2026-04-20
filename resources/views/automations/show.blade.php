<x-app-layout>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
    @endpush

    @slot('breadcrumb')
    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: var(--af-text-muted);">Inicio</a>
    <span>›</span>
    <a href="{{ route('automations.index') }}" style="text-decoration: none; color: var(--af-text-muted);">Automatizaciones</a>
    <span>›</span>
    <strong>{{ Str::limit($automation->name, 32) }}</strong>
    @endslot

    {{-- ── Encabezado de detalle ── --}}
    <div class="af-detail-header">
        <div class="af-detail-header__left">

            {{-- Icono de trigger --}}
            <div class="af-automation-card__trigger-icon af-automation-card__trigger-icon--{{ $automation->trigger_type }}"
                style="width: 52px; height: 52px; font-size: 1.5rem; border-radius: var(--af-radius);">
                @switch($automation->trigger_type)
                @case('email') 📧 @break
                @case('whatsapp') 💬 @break
                @case('registro') 👤 @break
                @case('pago') 💳 @break
                @case('webhook') 🔗 @break
                @case('schedule') ⏰ @break
                @default ⚡
                @endswitch
            </div>

            <div>
                <h1 class="af-detail-header__title">{{ $automation->name }}</h1>
                <div class="af-detail-header__meta">
                    <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                        <span class="af-badge-dot"></span>
                        {{ $automation->active ? 'Activa' : 'Inactiva' }}
                    </span>
                    <span class="af-badge af-badge--primary">
                        {{ ucfirst($automation->trigger_type) }}
                    </span>
                    <span style="font-size: 0.8rem; color: var(--af-text-muted);">
                        Creada {{ $automation->created_at->diffForHumans() }}
                    </span>
                </div>
                @if ($automation->description)
                <p style="margin: 10px 0 0; font-size: 0.875rem; color: var(--af-text-muted); max-width: 480px; line-height: 1.5;">
                    {{ $automation->description }}
                </p>
                @endif
            </div>
        </div>

        <div class="af-detail-header__actions">
            {{-- Toggle activo --}}
            <form method="POST" action="{{ route('automations.toggle', $automation) }}">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="af-btn {{ $automation->active ? 'af-btn--secondary' : 'af-btn--primary' }} af-btn--sm">
                    @if ($automation->active)
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pausar
                    @else
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Activar
                    @endif
                </button>
            </form>

            <a href="{{ route('automations.edit', $automation) }}" class="af-btn af-btn--secondary af-btn--sm">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar
            </a>
        </div>
    </div>

    {{-- ── Grid de detalle ── --}}
    <div class="af-detail-grid">

        {{-- Columna principal: historial de ejecuciones --}}
        <div>
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 style="font-size: 0.95rem; font-weight: 700; color: var(--af-text-dark); margin: 0 0 2px;">
                            Historial de ejecuciones
                        </h2>
                        <p style="font-size: 0.8rem; color: var(--af-text-muted); margin: 0;">
                            Últimas {{ $executions->count() ?? 0 }} ejecuciones registradas
                        </p>
                    </div>
                    <span class="af-badge af-badge--primary">
                        {{ $executions->total() ?? 0 }} total
                    </span>
                </div>

                <div class="af-card__body" style="padding: 0 24px;">
                    @forelse ($executions as $execution)
                    <div class="af-execution-item">
                        <span class="af-execution-status-dot af-execution-status-dot--{{ $execution->status }}"></span>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-size: 0.875rem; font-weight: 600; color: var(--af-text-dark); margin-bottom: 2px;">
                                @switch($execution->status)
                                @case('completed')
                                ✔ Ejecución exitosa
                                @break

                                @case('failed')
                                Error en ejecución
                                @break

                                @case('pending')
                                ⏳ En cola
                                @break

                                @case('processing')
                                ⚙️ Ejecutando
                                @break

                                @default
                                {{ ucfirst($execution->status) }}
                                @endswitch
                            </div>
                            @if($execution->result)
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 4px;">
                                {{ $execution->result }}
                            </div>
                            @endif
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <div style="font-size: 0.775rem; color: var(--af-text-placeholder);">
                                {{ $execution->created_at->format('d M, H:i') }}
                            </div>
                            @if ($execution->duration_ms)
                            <div style="font-size: 0.725rem; color: var(--af-text-placeholder); margin-top: 2px;">
                                {{ $execution->duration_ms }}ms
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="af-empty-state" style="padding: 40px 0;">
                        <div class="af-empty-state__icon">
                            <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3>Sin ejecuciones aún</h3>
                        <p>Esta automatización no ha sido disparada todavía</p>
                    </div>
                    @endforelse
                </div>

                @if (isset($executions) && $executions->hasPages())
                <div class="af-card__footer">
                    {{ $executions->links() }}
                </div>
                @endif
            </div>
        </div>

        {{-- Columna lateral: info y acciones --}}
        <div style="display: flex; flex-direction: column; gap: 16px;">

            {{-- Datos de la automatización --}}
            <div class="af-card">
                <div class="af-card__header">
                    <h2 style="font-size: 0.9rem; font-weight: 700; color: var(--af-text-dark); margin: 0;">
                        Detalles
                    </h2>
                </div>
                <div class="af-card__body">
                    <dl style="display: flex; flex-direction: column; gap: 14px; margin: 0;">

                        <div>
                            <dt style="font-size: 0.75rem; font-weight: 600; color: var(--af-text-muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">
                                Trigger
                            </dt>
                            <dd style="font-size: 0.875rem; color: var(--af-text-dark); font-weight: 500; margin: 0;">
                                @switch($automation->trigger_type)
                                @case('email') 📧 Email @break
                                @case('whatsapp') 💬 WhatsApp @break
                                @case('registro') 👤 Registro @break
                                @case('pago') 💳 Pago @break
                                @case('webhook') 🔗 Webhook @break
                                @case('schedule') ⏰ Programado @break
                                @default ⚡ {{ ucfirst($automation->trigger_type) }}
                                @endswitch
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size: 0.75rem; font-weight: 600; color: var(--af-text-muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">
                                Estado
                            </dt>
                            <dd style="margin: 0;">
                                <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                                    <span class="af-badge-dot"></span>
                                    {{ $automation->active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size: 0.75rem; font-weight: 600; color: var(--af-text-muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">
                                Creada
                            </dt>
                            <dd style="font-size: 0.875rem; color: var(--af-text-dark); margin: 0;">
                                {{ $automation->created_at->format('d \d\e M\., Y') }}
                            </dd>
                        </div>

                        <div>
                            <dt style="font-size: 0.75rem; font-weight: 600; color: var(--af-text-muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;">
                                Última modificación
                            </dt>
                            <dd style="font-size: 0.875rem; color: var(--af-text-dark); margin: 0;">
                                {{ $automation->updated_at->diffForHumans() }}
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>

            {{-- Zona de peligro --}}
            <div class="af-card" style="border-color: var(--af-danger-light);">
                <div class="af-card__header" style="background: var(--af-danger-light);">
                    <h2 style="font-size: 0.875rem; font-weight: 700; color: var(--af-danger); margin: 0;">
                        Zona de peligro
                    </h2>
                </div>
                <div class="af-card__body">
                    <p style="font-size: 0.8rem; color: var(--af-text-muted); margin: 0 0 14px; line-height: 1.5;">
                        Eliminar esta automatización es permanente. Se borrarán también todos sus registros de ejecución.
                    </p>
                    <form method="POST" action="{{ route('automations.destroy', $automation) }}"
                        onsubmit="return confirm('¿Eliminar «{{ addslashes($automation->name) }}»? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="af-btn af-btn--danger af-btn--sm af-btn--full">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Eliminar automatización
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>