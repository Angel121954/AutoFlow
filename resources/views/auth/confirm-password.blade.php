<x-guest-layout>

    <div style="margin-bottom: 28px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 40px; height: 40px; background: var(--af-warning-light); border-radius: var(--af-radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 1.3rem; font-weight: 700; color: var(--af-text-dark); margin: 0 0 3px; letter-spacing: -0.3px;">
                    Confirma tu identidad
                </h1>
            </div>
        </div>
        <p style="font-size: 0.875rem; color: var(--af-text-muted); line-height: 1.6; margin: 0;">
            Esta sección es segura y requiere confirmación. Por favor ingresa tu contraseña para continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" novalidate>
        @csrf

        <div class="af-field" style="margin-bottom: 24px;">
            <label for="password" class="af-label">Contraseña</label>
            <div class="af-input-group">
                <svg class="af-input-group__icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Tu contraseña actual"
                    required
                    autofocus
                    autocomplete="current-password"
                    class="af-input {{ $errors->has('password') ? 'af-input--error' : '' }}" />
            </div>
            @error('password')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="af-btn af-btn--primary af-btn--full af-btn--lg">
            Confirmar y continuar
        </button>
    </form>

</x-guest-layout>
