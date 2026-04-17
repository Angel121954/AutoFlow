{{--
    ╔══════════════════════════════════════════════════════════╗
    ║  COMPONENTE: automation-modal                           ║
    ║  Uso: <x-automation-modal />                            ║
    ╚══════════════════════════════════════════════════════════╝
--}}

@push('styles')
<style>
    /* ── Backdrop ── */
    .af-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(4px);
        z-index: 998;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 28px 16px 48px;
        overflow-y: auto;
        opacity: 0;
        pointer-events: none;
        transition: opacity .22s ease;
    }
    .af-modal-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    /* ── Caja del modal ── */
    .af-modal-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        width: 100%;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        margin: auto;
        transform: translateY(18px) scale(.97);
        transition: transform .24s cubic-bezier(.34,1.56,.64,1);
        box-shadow: 0 4px 6px rgba(0,0,0,.04), 0 24px 60px rgba(0,0,0,.12);
    }
    .af-modal-backdrop.open .af-modal-box {
        transform: translateY(0) scale(1);
    }

    /* ── Header ── */
    .af-modal-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        border-radius: 16px 16px 0 0;
        background: #f8fafc;
    }
    .af-modal-header__icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        color: #2563eb;
    }
    .af-modal-header__text  { flex: 1; min-width: 0; }
    .af-modal-header__title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 2px;
        line-height: 1.3;
    }
    .af-modal-header__subtitle {
        font-size: .78rem;
        color: #64748b;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .af-modal-close {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #fff;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        color: #94a3b8;
        flex-shrink: 0;
        transition: background .15s, color .15s, border-color .15s;
    }
    .af-modal-close:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #475569;
    }

    /* ── Body ── */
    .af-modal-body {
        padding: 18px 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        background: #ffffff;
    }

    /* ── Secciones ── */
    .af-modal-section {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }
    .af-modal-section__header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    .af-modal-section__step {
        width: 22px; height: 22px;
        border-radius: 50%;
        background: #2563eb;
        color: #fff;
        font-size: .7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .af-modal-section__title {
        font-size: .82rem;
        font-weight: 700;
        color: #1e293b;
    }
    .af-modal-section__body {
        padding: 16px;
        background: #ffffff;
    }

    /* ── Labels ── */
    #af-automation-form label.af-label {
        color: #374151 !important;
        font-size: .8rem;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }

    /* ── Inputs ── */
    #af-automation-form .af-input,
    #af-automation-form .af-textarea {
        background: #ffffff !important;
        border: 1px solid #d1d5db !important;
        color: #111827 !important;
        border-radius: 8px;
        padding: 10px 14px;
        width: 100%;
        box-sizing: border-box;
        font-size: .875rem;
        transition: border-color .15s, box-shadow .15s;
    }
    #af-automation-form .af-input:focus,
    #af-automation-form .af-textarea:focus {
        outline: none;
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.15) !important;
    }
    #af-automation-form .af-input::placeholder,
    #af-automation-form .af-textarea::placeholder { color: #9ca3af !important; }
    #af-automation-form .af-textarea { resize: vertical; min-height: 80px; }

    /* ── Trigger grid ── */
    .af-modal-trigger-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }
    @media (max-width: 480px) {
        .af-modal-trigger-grid { grid-template-columns: repeat(2, 1fr); }
    }
    .af-modal-trigger-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 14px 8px 12px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        cursor: pointer;
        transition: border-color .18s, background .18s, transform .12s;
        text-align: center;
        user-select: none;
        position: relative;
    }
    .af-modal-trigger-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
    }
    .af-modal-trigger-option:hover {
        border-color: #93c5fd;
        background: #eff6ff;
        transform: translateY(-1px);
    }
    .af-modal-trigger-option--selected {
        border-color: #2563eb !important;
        background: #eff6ff !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    }
    .af-modal-trigger-emoji {
        font-size: 1.5rem;
        line-height: 1;
    }
    .af-modal-trigger-label {
        font-size: .78rem;
        font-weight: 700;
        color: #1e293b;
    }
    .af-modal-trigger-desc {
        font-size: .67rem;
        color: #94a3b8;
        line-height: 1.3;
    }

    /* ── Estado toggle ── */
    .af-modal-status-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .af-modal-status-row__title {
        font-size: .875rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 3px;
    }
    .af-modal-status-row__desc {
        font-size: .78rem;
        color: #64748b;
    }

    /* ── Footer ── */
    .af-modal-footer {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: flex-end;
        padding: 16px 24px;
        border-top: 1px solid #e2e8f0;
        border-radius: 0 0 16px 16px;
        background: #f8fafc;
    }

    /* ── Errores ── */
    .af-modal-errors {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 12px 14px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 10px;
    }
    .af-modal-errors ul { margin: 0; padding: 0; list-style: none; }
    .af-modal-errors li  { font-size: .8rem; color: #b91c1c; margin-bottom: 2px; }

    /* ── Móvil ── */
    @media (max-width: 640px) {
        .af-modal-backdrop { align-items: flex-end; padding: 0; }
        .af-modal-box {
            margin: 0;
            border-radius: 16px 16px 0 0;
            max-height: 95vh;
            overflow-y: auto;
        }
    }
</style>
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

        {{-- Form --}}
        <form id="af-automation-form"
              method="POST"
              action="{{ route('automations.store') }}"
              novalidate>
            @csrf
            <input type="hidden" name="_method"    id="af-form-method" value="POST">
            <input type="hidden" name="editing_id" id="af-editing-id"  value="">

            <div class="af-modal-body">

                {{-- Errores --}}
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
