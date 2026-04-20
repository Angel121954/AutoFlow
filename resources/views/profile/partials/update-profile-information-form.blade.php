<div class="af-form-section">
    <div class="af-form-section__header">
        <span class="af-form-section__step">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </span>
        <span class="af-form-section__title">Información personal</span>
    </div>

    <div class="af-form-section__body">

        {{-- Avatar del usuario --}}
        <div class="af-profile-avatar-row">
            <div class="af-avatar af-avatar--lg">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <div class="af-profile-name">{{ Auth::user()->name }}</div>
                <div class="af-profile-since">Miembro desde {{ Auth::user()->created_at->format('M Y') }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" novalidate>
            @csrf @method('patch')

            <div class="af-field">
                <label for="name" class="af-label">Nombre completo</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input id="name" type="text" name="name"
                           value="{{ old('name', $user->name) }}"
                           required autofocus autocomplete="name"
                           class="af-input {{ $errors->userUpdate->has('name') ? 'af-input--error' : '' }}"/>
                </div>
                @if ($errors->userUpdate->has('name'))
                    <p class="af-field-error">{{ $errors->userUpdate->first('name') }}</p>
                @endif
            </div>

            <div class="af-field">
                <label for="email" class="af-label">Correo electrónico</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input id="email" type="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           required autocomplete="username"
                           class="af-input {{ $errors->userUpdate->has('email') ? 'af-input--error' : '' }}"/>
                </div>
                @if ($errors->userUpdate->has('email'))
                    <p class="af-field-error">{{ $errors->userUpdate->first('email') }}</p>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="af-alert af-alert--warning af-alert--mt">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>
                            Correo no verificado.
                            <form method="POST" action="{{ route('verification.send') }}" class="af-form--inline">
                                @csrf
                                <button type="submit" class="af-btn-link--warning">
                                    Reenviar verificación
                                </button>
                            </form>
                        </span>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="af-alert af-alert--success af-alert--mt-sm">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Enlace de verificación enviado.
                        </div>
                    @endif
                @endif
            </div>

            <div class="af-form-actions--start">
                <button type="submit" class="af-btn af-btn--primary">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar cambios
                </button>
                @if (session('status') === 'profile-updated')
                    <span class="af-badge af-badge--success af-badge--md">✓ Guardado</span>
                @endif
            </div>
        </form>
    </div>
</div>
