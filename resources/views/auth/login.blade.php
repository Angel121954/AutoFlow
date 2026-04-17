<x-guest-layout>

    <div class="af-auth-heading">
        <h1>Bienvenido</h1>
        <p>Inicia sesión en tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="af-field">
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

        {{-- Contraseña --}}
        <div class="af-field" style="margin-bottom: 12px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                <label for="password" class="af-label" style="margin-bottom: 0;">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="af-auth-link" style="font-size: 0.825rem;">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="af-input-group">
                <svg class="af-input-group__icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Tu contraseña"
                    required
                    autocomplete="current-password"
                    class="af-input {{ $errors->has('password') ? 'af-input--error' : '' }}" />
            </div>
            @error('password')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Recordarme --}}
        <div style="margin-bottom: 20px;">
            <label class="af-checkbox-label">
                <input type="checkbox" name="remember" class="af-checkbox">
                Recordarme en este dispositivo
            </label>
        </div>

        <button type="submit" class="af-btn af-btn--primary af-btn--full af-btn--lg">
            Iniciar sesión
        </button>
    </form>

    {{-- Divisor --}}
    <div class="af-divider" style="margin: 24px 0;">o continuar con</div>

    {{-- Social --}}
    <div class="af-auth-social">
        <a href="{{ route('social.redirect', 'google') }}" class="af-btn-social">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Iniciar sesión con Google
        </a>
        <a href="{{ route('social.redirect', 'github') }}" class="af-btn-social">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="#111827">
                <path d="M12 .5C5.65.5.75 5.4.75 11.75c0 5.08 3.29 9.39 7.85 10.91.57.1.78-.25.78-.56v-2.03c-3.19.69-3.86-1.54-3.86-1.54-.52-1.32-1.27-1.67-1.27-1.67-1.04-.71.08-.7.08-.7 1.15.08 1.75 1.18 1.75 1.18 1.02 1.75 2.67 1.24 3.32.95.1-.74.4-1.24.73-1.53-2.55-.29-5.23-1.27-5.23-5.66 0-1.25.45-2.27 1.18-3.07-.12-.29-.51-1.47.11-3.06 0 0 .96-.31 3.15 1.17a10.9 10.9 0 0 1 5.73 0c2.19-1.48 3.15-1.17 3.15-1.17.62 1.59.23 2.77.11 3.06.73.8 1.18 1.82 1.18 3.07 0 4.4-2.68 5.37-5.24 5.65.41.36.77 1.08.77 2.18v3.23c0 .31.2.67.79.56A11.26 11.26 0 0 0 23.25 11.75C23.25 5.4 18.35.5 12 .5z"/>
            </svg>
            Iniciar sesión con GitHub
        </a>
    </div>

    {{-- Pie --}}
    <p class="af-auth-footer">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="af-auth-link" style="margin-left: 4px;">Regístrate gratis</a>
    </p>

</x-guest-layout>
