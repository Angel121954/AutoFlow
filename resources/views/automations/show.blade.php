<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
    @endpush

    @slot('breadcrumb')
        <a href="{{ route('dashboard') }}" class="af-breadcrumb-link">Inicio</a>
        <span>›</span>
        <a href="{{ route('automations.index') }}" class="af-breadcrumb-link">Automatizaciones</a>
        <span>›</span>
        <strong>{{ Str::limit($automation->name, 32) }}</strong>
    @endslot

    {{-- ── Encabezado de detalle ── --}}
    <div class="af-detail-header">
        <div class="af-detail-header__left">

            <div class="af-automation-card__trigger-icon af-trigger-icon--lg af-automation-card__trigger-icon--{{ $automation->trigger_type }}">
                @switch($automation->trigger_type)
                    @case('email')    📧 @break
                    @case('whatsapp') 💬 @break
                    @case('registro') 👤 @break
                    @case('pago')     💳 @break
                    @case('webhook')  🔗 @break
                    @case('schedule') ⏰ @break
                    @default          ⚡
                @endswitch
            </div>

            <div>
                <h1 class="af-detail-header__title">{{ $automation->name }}</h1>
                <div class="af-detail-header__meta">
                    <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                        <span class="af-badge-dot"></span>
                        {{ $automation->active ? 'Activa' : 'Inactiva' }}
                    </span>
                    <span class="af-badge af-badge--primary">{{ ucfirst($automation->trigger_type) }}</span>
                    <span class="af-detail-header__date">Creada {{ $automation->created_at->diffForHumans() }}</span>
                </div>
                @if ($automation->description)
                    <p class="af-detail-header__desc">{{ $automation->description }}</p>
                @endif
            </div>
        </div>

        <div class="af-detail-header__actions">
            <form method="POST" action="{{ route('automations.toggle', $automation) }}">
                @csrf @method('PATCH')
                <button type="submit" class="af-btn {{ $automation->active ? 'af-btn--secondary' : 'af-btn--primary' }} af-btn--sm">
                    @if ($automation->active)
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pausar
                    @else
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Activar
                    @endif
                </button>
            </form>

            <a href="{{ route('automations.edit', $automation) }}" class="af-btn af-btn--secondary af-btn--sm">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
        </div>
    </div>

    {{-- ── Grid de detalle ── --}}
    <div class="af-detail-grid">

        {{-- Columna principal: historial ── --}}
        <div>
            <div class="af-card">
                <div class="af-card__header">
                    <div>
                        <h2 class="af-card__title">Historial de ejecuciones</h2>
                        <p class="af-card__subtitle">Últimas {{ $executions->count() ?? 0 }} ejecuciones registradas</p>
                    </div>
                    <span class="af-badge af-badge--primary">{{ $executions->total() ?? 0 }} total</span>
                </div>

                <div class="af-card__body af-card__body--px-only">
                    @forelse ($executions ?? [] as $execution)
                        <div class="af-execution-item">
                            <span class="af-execution-status-dot af-execution-status-dot--{{ $execution->status }}"></span>
                            <div class="af-execution-item__info">
                                <div class="af-execution-item__title">
                                    @switch($execution->status)
                                        @case('success') Ejecución exitosa @break
                                        @case('error')   Error en ejecución @break
                                        @case('pending') En cola @break
                                        @default         {{ ucfirst($execution->status) }}
                                    @endswitch
                                </div>
                                @if ($execution->message)
                                    <div class="af-execution-item__message">{{ $execution->message }}</div>
                                @endif
                            </div>
                            <div class="af-execution-item__time">
                                <div class="af-execution-item__time-text">
                                    {{ $execution->created_at->format('d M, H:i') }}
                                </div>
                                @if ($execution->duration_ms)
                                    <div class="af-execution-item__duration">{{ $execution->duration_ms }}ms</div>
                                @endif
                            </div>
                        </div>
                    @empty
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
                    @endforelse
                </div>

                @if (isset($executions) && $executions->hasPages())
                    <div class="af-card__footer">{{ $executions->links() }}</div>
                @endif
            </div>
        </div>

        {{-- Columna lateral: detalles + zona de peligro ── --}}
        <div class="af-detail-col">

            {{-- Detalles --}}
            <div class="af-card">
                <div class="af-card__header">
                    <h2 class="af-card__title">Detalles</h2>
                </div>
                <div class="af-card__body">
                    <dl class="af-details-list">
                        <div>
                            <dt>Trigger</dt>
                            <dd>
                                @switch($automation->trigger_type)
                                    @case('email')    📧 Email @break
                                    @case('whatsapp') 💬 WhatsApp @break
                                    @case('registro') 👤 Registro @break
                                    @case('pago')     💳 Pago @break
                                    @case('webhook')  🔗 Webhook @break
                                    @case('schedule') ⏰ Programado @break
                                    @default          ⚡ {{ ucfirst($automation->trigger_type) }}
                                @endswitch
                            </dd>
                        </div>
                        <div>
                            <dt>Estado</dt>
                            <dd class="af-details-list__badge">
                                <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                                    <span class="af-badge-dot"></span>
                                    {{ $automation->active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt>Creada</dt>
                            <dd>{{ $automation->created_at->format('d \d\e M\., Y') }}</dd>
                        </div>
                        <div>
                            <dt>Última modificación</dt>
                            <dd>{{ $automation->updated_at->diffForHumans() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Zona de peligro --}}
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
                          action="{{ route('automations.destroy', $automation) }}">
                        @csrf @method('DELETE')
                        <button type="button"
                                class="af-btn af-btn--danger af-btn--sm af-btn--full"
                                id="af-destroy-btn"
                                data-name="{{ addslashes($automation->name) }}">
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

    @push('scripts')
        <script src="{{ asset('js/app/automations.js') }}"></script>
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
    @endpush

</x-app-layout>
