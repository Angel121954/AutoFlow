<x-guest-layout>

    <div class="af-auth-heading">
        <h1>Nueva contraseña</h1>
        <p>Elige una contraseña segura para tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email (oculto visualmente, requerido por Laravel) --}}
        <div class="af-field">
            <label for="email" class="af-label">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autocomplete="username"
                class="af-input {{ $errors->has('email') ? 'af-input--error' : '' }}" />
            @error('email')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div class="af-field">
            <label for="password" class="af-label">Nueva contraseña</label>
            <div class="af-input-group">
                <svg class="af-input-group__icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Mínimo 8 caracteres"
                    required
                    autocomplete="new-password"
                    class="af-input {{ $errors->has('password') ? 'af-input--error' : '' }}" />
            </div>
            @error('password')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="af-field" style="margin-bottom: 24px;">
            <label for="password_confirmation" class="af-label">Confirmar contraseña</label>
            <div class="af-input-group">
                <svg class="af-input-group__icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Repite tu contraseña"
                    required
                    autocomplete="new-password"
                    class="af-input {{ $errors->has('password_confirmation') ? 'af-input--error' : '' }}" />
            </div>
            @error('password_confirmation')
                <p class="af-field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="af-btn af-btn--primary af-btn--full af-btn--lg">
            Restablecer contraseña
        </button>
    </form>

</x-guest-layout>
