<x-guest-layout>
    <div class="auth-card w-full max-w-md mx-auto">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-3 mb-8">
            <span class="logo-icon">
                <span class="logo-square logo-sq-1"></span>
                <span class="logo-square logo-sq-2"></span>
                <span class="logo-square logo-sq-3"></span>
            </span>
            <span style="font-size: 1.6rem; font-weight: 700; color: #1e293b; letter-spacing: -0.5px;">AutoFlow</span>
        </div>

        {{-- Heading --}}
        <div class="text-center mb-8">
            <h1 style="font-size: 1.75rem; font-weight: 700; color: #1e293b; letter-spacing: -0.4px;">
                Bienvenido
            </h1>
            <p style="margin-top: 6px; font-size: 0.95rem; color: #64748b;">
                Inicia sesión en tu cuenta
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <label for="email"
                    style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 6px;">
                    Correo electrónico
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="tú@ejemplo.com"
                    required
                    autofocus
                    autocomplete="username"
                    class="auth-input w-full"
                    style="padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.95rem; color: #1e293b; background: #fff; width: 100%; box-sizing: border-box;" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mb-2">
                <label for="password"
                    style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 6px;">
                    Contraseña
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="auth-input w-full"
                    style="padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 0.95rem; color: #1e293b; background: #fff; width: 100%; box-sizing: border-box;" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Forgot Password --}}
            <div class="flex justify-end mb-6">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    style="font-size: 0.875rem; font-weight: 500; color: #2563EB; text-decoration: none;"
                    onmouseover="this.style.color='#1d4ed8'"
                    onmouseout="this.style.color='#2563EB'">
                    ¿Olvidaste tu contraseña?
                </a>
                @endif
            </div>

            {{-- Sign In Button --}}
            <button type="submit"
                class="btn-signin w-full"
                style="padding: 13px; border: none; border-radius: 8px; color: #fff; font-size: 1rem; font-weight: 600; cursor: pointer; width: 100%; letter-spacing: 0.01em;">
                Iniciar sesión
            </button>
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </form>

        {{-- Divider --}}
        <div style="display: flex; align-items: center; gap: 14px; margin: 28px 0;">
            <span class="divider-line"></span>
            <span style="font-size: 0.85rem; color: #94a3b8; white-space: nowrap;">o continuar con</span>
            <span class="divider-line"></span>
        </div>

        {{-- Social Buttons --}}
        <div style="display: flex; flex-direction: column; gap: 12px;">

            {{-- Google --}}
            <a href="{{ route('social.redirect', 'google') }}"
                class="btn-social"
                style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 12px; border-radius: 8px; text-decoration: none; background: #fff; cursor: pointer;">
                <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                </svg>
                <span style="font-size: 0.925rem; font-weight: 600; color: #374151;">Iniciar sesión con Google</span>
            </a>

            {{-- GitHub --}}
            <a href="{{ route('social.redirect', 'github') }}"
                class="btn-social"
                style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 12px; border-radius: 8px; text-decoration: none; background: #fff; cursor: pointer;">

                <svg width="20" height="20" viewBox="0 0 24 24" fill="#111827" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 .5C5.65.5.75 5.4.75 11.75c0 5.08 3.29 9.39 7.85 10.91.57.1.78-.25.78-.56v-2.03c-3.19.69-3.86-1.54-3.86-1.54-.52-1.32-1.27-1.67-1.27-1.67-1.04-.71.08-.7.08-.7 1.15.08 1.75 1.18 1.75 1.18 1.02 1.75 2.67 1.24 3.32.95.1-.74.4-1.24.73-1.53-2.55-.29-5.23-1.27-5.23-5.66 0-1.25.45-2.27 1.18-3.07-.12-.29-.51-1.47.11-3.06 0 0 .96-.31 3.15 1.17a10.9 10.9 0 0 1 5.73 0c2.19-1.48 3.15-1.17 3.15-1.17.62 1.59.23 2.77.11 3.06.73.8 1.18 1.82 1.18 3.07 0 4.4-2.68 5.37-5.24 5.65.41.36.77 1.08.77 2.18v3.23c0 .31.2.67.79.56A11.26 11.26 0 0 0 23.25 11.75C23.25 5.4 18.35.5 12 .5z" />
                </svg>

                <span style="font-size: 0.925rem; font-weight: 600; color: #374151;">
                    Iniciar sesión con GitHub
                </span>
            </a>
        </div>

        {{-- Divider --}}
        <div style="height: 1px; background: #e2e8f0; margin: 28px 0;"></div>

        {{-- Sign Up Link --}}
        <p style="text-align: center; font-size: 0.9rem; color: #64748b;">
            ¿No tienes una cuenta?
            <a href="{{ route('register') }}"
                style="color: #2563EB; font-weight: 600; text-decoration: none; margin-left: 4px;"
                onmouseover="this.style.color='#1d4ed8'"
                onmouseout="this.style.color='#2563EB'">
                Regístrate
            </a>
        </p>
    </div>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    @endpush
</x-guest-layout>