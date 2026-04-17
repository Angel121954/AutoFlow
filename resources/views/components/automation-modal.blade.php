{{--
    ╔══════════════════════════════════════════════════════════╗
    ║  COMPONENTE: automation-modal                           ║
    ║  Uso: <x-automation-modal />                            ║
    ║  CSS: public/css/app/automation-modal.css               ║
    ╚══════════════════════════════════════════════════════════╝
--}}

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app/automation-modal.css') }}">
@endpush

<div class="af-modal-backdrop"
     id="af-automation-modal"
     onclick="handleBackdropClick(event)">

    <div class="af-modal-box" role="dialog" aria-modal="true" aria-labelledby="af-modal-title">

        {{-- Header --}}
        <div class="af-modal-header">
            <div class="af-modal-header__icon" id="af-modal-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div class="af-modal-header__text">
                <h2 class="af-modal-header__title" id="af-modal-title">Nueva automatización</h2>
                <p  class="af-modal-header__subtitle" id="af-modal-subtitle">
                    Configura un flujo automático para tu negocio
                </p>
            </div>
            <button class="af-modal-close" onclick="closeModal()" aria-label="Cerrar">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Formulario --}}
        <form id="af-automation-form"
              method="POST"
              action="{{ route('automations.store') }}"
              novalidate>
            @csrf
            <input type="hidden" name="_method"    id="af-form-method" value="POST">
            <input type="hidden" name="editing_id" id="af-editing-id"  value="">

            <div class="af-modal-body">

                {{-- Errores de validación --}}
                @if ($errors->any())
                <div class="af-modal-errors">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                         stroke="#dc2626" stroke-width="2" style="flex-shrink:0;margin-top:1px;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- ① Información básica --}}
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">1</span>
                        <span class="af-modal-section__title">Información básica</span>
                    </div>
                    <div class="af-modal-section__body">
                        <div class="af-field">
                            <label for="modal-name" class="af-label">
                                Nombre de la automatización
                            </label>
                            <input id="modal-name" type="text" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Ej: Bienvenida a nuevos usuarios"
                                   required
                                   class="af-input {{ $errors->has('name') ? 'af-input--error' : '' }}"/>
                            @error('name')
                                <p class="af-field-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="af-field" style="margin-bottom:0;">
                            <label for="modal-description" class="af-label">
                                Descripción
                                <span style="font-weight:400;color:#9ca3af;margin-left:4px;">(opcional)</span>
                            </label>
                            <textarea id="modal-description" name="description"
                                      rows="3"
                                      placeholder="Describe qué hace esta automatización..."
                                      class="af-input af-textarea {{ $errors->has('description') ? 'af-input--error' : '' }}">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="af-field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ② Tipo de trigger --}}
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">2</span>
                        <span class="af-modal-section__title">Tipo de trigger</span>
                    </div>
                    <div class="af-modal-section__body">
                        <p style="font-size:.78rem;color:#64748b;margin:0 0 12px;">
                            ¿Qué evento dispara esta automatización?
                        </p>
                        <div class="af-modal-trigger-grid" id="af-modal-trigger-grid">
                            @foreach ([
                                ['value' => 'email',    'emoji' => '📧', 'label' => 'Email',      'desc' => 'Al recibir correo'],
                                ['value' => 'whatsapp', 'emoji' => '💬', 'label' => 'WhatsApp',   'desc' => 'Mensaje entrante'],
                                ['value' => 'registro', 'emoji' => '👤', 'label' => 'Registro',   'desc' => 'Nuevo usuario'],
                                ['value' => 'pago',     'emoji' => '💳', 'label' => 'Pago',       'desc' => 'Pago completado'],
                                ['value' => 'webhook',  'emoji' => '🔗', 'label' => 'Webhook',    'desc' => 'Llamada HTTP'],
                                ['value' => 'schedule', 'emoji' => '⏰', 'label' => 'Programado', 'desc' => 'A una hora fija'],
                            ] as $t)
                            <label class="af-modal-trigger-option {{ old('trigger_type') === $t['value'] ? 'af-modal-trigger-option--selected' : '' }}"
                                   data-value="{{ $t['value'] }}"
                                   onclick="selectModalTrigger(this)">
                                <input type="radio" name="trigger_type" value="{{ $t['value'] }}"
                                       {{ old('trigger_type') === $t['value'] ? 'checked' : '' }} required>
                                <span class="af-modal-trigger-emoji">{{ $t['emoji'] }}</span>
                                <span class="af-modal-trigger-label">{{ $t['label'] }}</span>
                                <span class="af-modal-trigger-desc">{{ $t['desc'] }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('trigger_type')
                            <p class="af-field-error" style="margin-top:8px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ③ Estado --}}
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">3</span>
                        <span class="af-modal-section__title" id="af-modal-status-label">Estado inicial</span>
                    </div>
                    <div class="af-modal-section__body">
                        <div class="af-modal-status-row">
                            <div>
                                <div class="af-modal-status-row__title" id="af-modal-status-title">
                                    Activar al crear
                                </div>
                                <div class="af-modal-status-row__desc" id="af-modal-status-desc">
                                    La automatización comenzará a ejecutarse inmediatamente
                                </div>
                            </div>
                            <label class="af-toggle">
                                <input type="checkbox" name="active" id="modal-active" value="1" checked>
                                <span class="af-toggle-track"><span class="af-toggle-thumb"></span></span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>{{-- /af-modal-body --}}

            {{-- Footer --}}
            <div class="af-modal-footer">
                <button type="button" class="af-btn af-btn--secondary" onclick="closeModal()">
                    Cancelar
                </button>
                <button type="submit" class="af-btn af-btn--primary" id="af-modal-submit">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span id="af-modal-submit-text">Crear automatización</span>
                </button>
            </div>

        </form>
    </div>
</div>
