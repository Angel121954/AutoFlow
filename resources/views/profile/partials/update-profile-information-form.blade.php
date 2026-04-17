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

        {{-- Avatar --}}
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--af-border-light);">
            <div class="af-avatar af-avatar--lg" style="font-size: 1.1rem;">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <div style="font-size: 0.875rem; font-weight: 600; color: var(--af-text-dark); margin-bottom: 2px;">
                    {{ Auth::user()->name }}
                </div>
                <div style="font-size: 0.8rem; color: var(--af-text-muted);">
                    Miembro desde {{ Auth::user()->created_at->format('M Y') }}
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" novalidate>
            @csrf
            @method('patch')

            {{-- Nombre --}}
            <div class="af-field">
                <label for="name" class="af-label">Nombre completo</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="af-input {{ $errors->userUpdate->has('name') ? 'af-input--error' : '' }}" />
                </div>
                @if ($errors->userUpdate->has('name'))
                    <p class="af-field-error">{{ $errors->userUpdate->first('name') }}</p>
                @endif
            </div>

            {{-- Email --}}
            <div class="af-field" style="margin-bottom: 20px;">
                <label for="email" class="af-label">Correo electrónico</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="af-input {{ $errors->userUpdate->has('email') ? 'af-input--error' : '' }}" />
                </div>
                @if ($errors->userUpdate->has('email'))
                    <p class="af-field-error">{{ $errors->userUpdate->first('email') }}</p>
                @endif

                {{-- Verificación de email pendiente --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="af-alert af-alert--warning" style="margin-top: 10px;">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>
                            Correo no verificado.
                            <form method="POST" action="{{ route('verification.send') }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; padding: 0; color: var(--af-warning-text); font-weight: 600; cursor: pointer; font-family: inherit; font-size: inherit; text-decoration: underline;">
                                    Reenviar verificación
                                </button>
                            </form>
                        </span>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="af-alert af-alert--success" style="margin-top: 8px;">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Enlace de verificación enviado.
                        </div>
                    @endif
                @endif
            </div>

            <div class="af-form-actions" style="justify-content: flex-start; padding-top: 0;">
                <button type="submit" class="af-btn af-btn--primary">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar cambios
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="af-badge af-badge--success" style="padding: 6px 12px;">
                        ✓ Guardado
                    </span>
                @endif
            </div>
        </form>
    </div>
</div>
