<x-app-layout>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
    @endpush

    @slot('breadcrumb')
    <a href="{{ route('dashboard') }}" style="text-decoration:none; color:var(--af-text-muted);">Inicio</a>
    <span>›</span>
    <strong>Automatizaciones</strong>
    @endslot

    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Mis Automatizaciones</h1>
            <p>Gestiona y monitorea todos tus flujos automáticos</p>
        </div>
        <div class="af-page-header__actions">
            <button class="af-btn af-btn--primary" onclick="openCreateModal()">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nueva automatización
            </button>
        </div>
    </div>

    <div class="af-filters">
        <div class="af-search-box">
            <svg class="af-search-box__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="search" placeholder="Buscar automatización..." class="af-input"
                id="af-search-input" oninput="filterAutomations()" style="padding-left:40px;" />
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

    @if ($automations->isEmpty())
    <div style="border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; padding: 72px 40px; display: flex; flex-direction: column; align-items: center; text-align: center;">
        <div style="width: 72px; height: 72px; border-radius: 20px; background: #eff6ff; border: 1px solid #bfdbfe; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
            <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <h3 style="font-size:1.2rem;font-weight:700;color:#0f172a;margin:0 0 10px;">Sin automatizaciones aún</h3>
        <p style="font-size:.9rem;color:#64748b;margin:0 0 32px;max-width:400px;line-height:1.7;">
            Crea tu primera automatización y empieza a ahorrar tiempo en tus procesos de negocio de forma inteligente.
        </p>
        <button class="af-btn af-btn--primary" onclick="openCreateModal()" style="padding:11px 24px;font-size:.9rem;">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Crear primera automatización
        </button>
    </div>
    @else
    <div class="af-automations-grid" id="af-automations-grid">
        @foreach ($automations as $automation)
        <div class="af-automation-card"
            data-name="{{ strtolower($automation->name) }}"
            data-status="{{ $automation->active ? 'active' : 'inactive' }}"
            data-trigger="{{ $automation->trigger_type }}">

            <div class="af-automation-card__header">
                <div class="af-automation-card__title-row">
                    <div class="af-automation-card__trigger-icon af-automation-card__trigger-icon--{{ $automation->trigger_type }}">
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
                    <div class="af-automation-card__info">
                        <div class="af-automation-card__name" title="{{ $automation->name }}">{{ $automation->name }}</div>
                        @if ($automation->description)
                        <div class="af-automation-card__desc">{{ $automation->description }}</div>
                        @else
                        <div class="af-automation-card__desc" style="color:var(--af-text-placeholder); font-style:italic;">Sin descripción</div>
                        @endif
                    </div>
                </div>
                <div class="af-automation-card__toggle">
                    <form method="POST" action="{{ route('automations.toggle', $automation) }}">
                        @csrf @method('PATCH')
                        <label class="af-toggle" title="{{ $automation->active ? 'Desactivar' : 'Activar' }}">
                            <input type="checkbox" {{ $automation->active ? 'checked' : '' }} onchange="this.closest('form').submit()">
                            <span class="af-toggle-track"><span class="af-toggle-thumb"></span></span>
                        </label>
                    </form>
                </div>
            </div>

            <div class="af-automation-card__flow">
                <span class="af-flow-arrow">→</span>
                <button class="af-btn af-btn--primary af-btn--sm af-btn--ai" onclick="runAutomation({{ $automation->id }})">
                    Ejecutar automatización
                </button>
            </div>

            <div class="af-automation-card__footer">
                <div class="af-automation-card__meta">
                    <span class="af-badge {{ $automation->active ? 'af-badge--success' : 'af-badge--muted' }}">
                        <span class="af-badge-dot"></span>
                        {{ $automation->active ? 'Activa' : 'Inactiva' }}
                    </span>
                    <span class="af-badge af-badge--primary">{{ ucfirst($automation->trigger_type) }}</span>
                </div>
                <div class="af-automation-card__actions">
                    <a href="{{ route('automations.show', $automation) }}" class="af-automation-card__action-btn" title="Ver detalle">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <button class="af-automation-card__action-btn" title="Editar"
                        onclick="openEditModal({
                            id:           {{ $automation->id }},
                            name:         {{ json_encode($automation->name) }},
                            description:  {{ json_encode($automation->description ?? '') }},
                            trigger_type: {{ json_encode($automation->trigger_type) }},
                            active:       {{ $automation->active ? 'true' : 'false' }}
                        })">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <form id="delete-form-{{ $automation->id }}" method="POST" action="{{ route('automations.destroy', $automation) }}" style="display:none;">
                        @csrf @method('DELETE')
                    </form>
                    <button class="af-automation-card__action-btn af-automation-card__action-btn--danger" title="Eliminar"
                        onclick="confirmDelete({{ $automation->id }}, {{ json_encode($automation->name) }})">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    @if ($automations->hasPages())
    <div style="margin-top:28px;">{{ $automations->links() }}</div>
    @endif
    @endif

    <x-automation-modal />

    @push('scripts')
    @include('automations._scripts')
    @endpush

</x-app-layout>