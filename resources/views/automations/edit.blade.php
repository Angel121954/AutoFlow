<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
    @endpush

    @slot('breadcrumb')
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: var(--af-text-muted);">Inicio</a>
        <span>›</span>
        <a href="{{ route('automations.index') }}" style="text-decoration: none; color: var(--af-text-muted);">Automatizaciones</a>
        <span>›</span>
        <a href="{{ route('automations.show', $automation) }}" style="text-decoration: none; color: var(--af-text-muted);">
            {{ Str::limit($automation->name, 24) }}
        </a>
        <span>›</span>
        <strong>Editar</strong>
    @endslot

    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Editar automatización</h1>
            <p>Modifica la configuración de «{{ $automation->name }}»</p>
        </div>
        <div class="af-page-header__actions">
            <a href="{{ route('automations.show', $automation) }}" class="af-btn af-btn--secondary">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Cancelar
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('automations.update', $automation) }}" class="af-form-page" novalidate>
        @csrf
        @method('PUT')

        {{-- Sección 1: Información básica --}}
        <div class="af-form-section">
            <div class="af-form-section__header">
                <span class="af-form-section__step">1</span>
                <span class="af-form-section__title">Información básica</span>
            </div>
            <div class="af-form-section__body">

                <div class="af-field">
                    <label for="name" class="af-label">Nombre de la automatización</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $automation->name) }}"
                        placeholder="Ej: Bienvenida a nuevos usuarios"
                        required
                        autofocus
                        class="af-input {{ $errors->has('name') ? 'af-input--error' : '' }}" />
                    @error('name')
                        <p class="af-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="af-field" style="margin-bottom: 0;">
                    <label for="description" class="af-label">
                        Descripción
                        <span style="font-weight: 400; color: var(--af-text-placeholder); margin-left: 4px;">(opcional)</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe qué hace esta automatización..."
                        class="af-input af-textarea {{ $errors->has('description') ? 'af-input--error' : '' }}">{{ old('description', $automation->description) }}</textarea>
                    @error('description')
                        <p class="af-field-error">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Sección 2: Tipo de trigger --}}
        <div class="af-form-section">
            <div class="af-form-section__header">
                <span class="af-form-section__step">2</span>
                <span class="af-form-section__title">Tipo de trigger</span>
            </div>
            <div class="af-form-section__body">

                <p style="font-size: 0.85rem; color: var(--af-text-muted); margin: 0 0 16px;">
                    Selecciona qué evento dispara esta automatización
                </p>

                <div class="af-trigger-grid">
                    @foreach ([
                        ['value' => 'email',    'emoji' => '📧', 'label' => 'Email',      'desc' => 'Al recibir correo'],
                        ['value' => 'whatsapp', 'emoji' => '💬', 'label' => 'WhatsApp',   'desc' => 'Mensaje entrante'],
                        ['value' => 'registro', 'emoji' => '👤', 'label' => 'Registro',   'desc' => 'Nuevo usuario'],
                        ['value' => 'pago',     'emoji' => '💳', 'label' => 'Pago',       'desc' => 'Pago completado'],
                        ['value' => 'webhook',  'emoji' => '🔗', 'label' => 'Webhook',    'desc' => 'Llamada HTTP'],
                        ['value' => 'schedule', 'emoji' => '⏰', 'label' => 'Programado', 'desc' => 'A una hora fija'],
                    ] as $trigger)
                        @php $selected = old('trigger_type', $automation->trigger_type) === $trigger['value']; @endphp
                        <label class="af-trigger-option {{ $selected ? 'af-trigger-option--selected' : '' }}"
                               onclick="selectTrigger(this, '{{ $trigger['value'] }}')">
                            <input type="radio"
                                   name="trigger_type"
                                   value="{{ $trigger['value'] }}"
                                   {{ $selected ? 'checked' : '' }}>
                            <div class="af-trigger-option__emoji">{{ $trigger['emoji'] }}</div>
                            <div>
                                <div class="af-trigger-option__label">{{ $trigger['label'] }}</div>
                                <div style="font-size: 0.72rem; color: var(--af-text-placeholder); margin-top: 2px;">{{ $trigger['desc'] }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('trigger_type')
                    <p class="af-field-error" style="margin-top: 10px;">{{ $message }}</p>
                @enderror

            </div>
        </div>

        {{-- Sección 3: Estado --}}
        <div class="af-form-section">
            <div class="af-form-section__header">
                <span class="af-form-section__step">3</span>
                <span class="af-form-section__title">Estado</span>
            </div>
            <div class="af-form-section__body">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                    <div>
                        <div style="font-size: 0.875rem; font-weight: 600; color: var(--af-text-dark); margin-bottom: 3px;">
                            Automatización activa
                        </div>
                        <div style="font-size: 0.8rem; color: var(--af-text-muted);">
                            Desactiva temporalmente sin eliminar la configuración
                        </div>
                    </div>
                    <label class="af-toggle">
                        <input type="checkbox" name="active" value="1"
                               {{ old('active', $automation->active) ? 'checked' : '' }}>
                        <span class="af-toggle-track">
                            <span class="af-toggle-thumb"></span>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Zona de peligro --}}
        <div class="af-form-section" style="border-color: var(--af-danger-light);">
            <div class="af-form-section__header" style="background: var(--af-danger-light);">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="af-form-section__title" style="color: var(--af-danger);">Zona de peligro</span>
            </div>
            <div class="af-form-section__body">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                    <div>
                        <div style="font-size: 0.875rem; font-weight: 600; color: var(--af-text-dark); margin-bottom: 3px;">
                            Eliminar automatización
                        </div>
                        <div style="font-size: 0.8rem; color: var(--af-text-muted);">
                            Esta acción es permanente y no se puede deshacer
                        </div>
                    </div>
                    <form method="POST" action="{{ route('automations.destroy', $automation) }}"
                          onsubmit="return confirm('¿Eliminar «{{ addslashes($automation->name) }}»? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="af-btn af-btn--danger af-btn--sm">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="af-form-actions">
            <a href="{{ route('automations.show', $automation) }}" class="af-btn af-btn--secondary">
                Cancelar
            </a>
            <button type="submit" class="af-btn af-btn--primary">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar cambios
            </button>
        </div>

    </form>

    @push('scripts')
    <script>
        function selectTrigger(el, value) {
            document.querySelectorAll('.af-trigger-option').forEach(opt => {
                opt.classList.remove('af-trigger-option--selected');
            });
            el.classList.add('af-trigger-option--selected');
            el.querySelector('input[type="radio"]').checked = true;
        }
    </script>
    @endpush

</x-app-layout>
