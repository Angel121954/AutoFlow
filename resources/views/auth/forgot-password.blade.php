<x-guest-layout>

    <div class="af-auth-heading">
        <h1>Recuperar contraseña</h1>
        <p>Te enviaremos un enlace para restablecer tu contraseña</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <div class="af-field" style="margin-bottom: 24px;">
            <label for="email" class="af-label">Correo electrónico</label>
            <div class="af-input-group">
                <svg class="af-input-group__icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="tú@ejemplo.com"
                    required
                    autofocus
                    autocomplete="username"
                    class="af-input {{ $errors->has('email') ? 'af-input--error' : '' }}" />
            </div>
            @error('email')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="af-btn af-btn--primary af-btn--full af-btn--lg">
            Enviar enlace de recuperación
        </button>
    </form>

    <p class="af-auth-footer">
        <a href="{{ route('login') }}" class="af-auth-link">
            ← Volver al inicio de sesión
        </a>
    </p>

</x-guest-layout>
