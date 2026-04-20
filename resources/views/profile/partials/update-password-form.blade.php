<div class="af-form-section">
    <div class="af-form-section__header">
        <span class="af-form-section__step">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </span>
        <span class="af-form-section__title">Cambiar contraseña</span>
    </div>

    <div class="af-form-section__body">
        <form method="POST" action="{{ route('password.update') }}" novalidate>
            @csrf @method('put')

            <div class="af-field">
                <label for="current_password" class="af-label">Contraseña actual</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input id="current_password" type="password" name="current_password"
                           placeholder="Tu contraseña actual" autocomplete="current-password"
                           class="af-input {{ $errors->updatePassword->has('current_password') ? 'af-input--error' : '' }}"/>
                </div>
                @if ($errors->updatePassword->has('current_password'))
                    <p class="af-field-error">{{ $errors->updatePassword->first('current_password') }}</p>
                @endif
            </div>

            <div class="af-field">
                <label for="password" class="af-label">Nueva contraseña</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input id="password" type="password" name="password"
                           placeholder="Mínimo 8 caracteres" autocomplete="new-password"
                           class="af-input {{ $errors->updatePassword->has('password') ? 'af-input--error' : '' }}"/>
                </div>
                @if ($errors->updatePassword->has('password'))
                    <p class="af-field-error">{{ $errors->updatePassword->first('password') }}</p>
                @endif
            </div>

            <div class="af-field">
                <label for="password_confirmation" class="af-label">Confirmar nueva contraseña</label>
                <div class="af-input-group">
                    <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           placeholder="Repite tu nueva contraseña" autocomplete="new-password"
                           class="af-input {{ $errors->updatePassword->has('password_confirmation') ? 'af-input--error' : '' }}"/>
                </div>
                @if ($errors->updatePassword->has('password_confirmation'))
                    <p class="af-field-error">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                @endif
            </div>

            <div class="af-form-actions--start">
                <button type="submit" class="af-btn af-btn--primary">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Actualizar contraseña
                </button>
                @if (session('status') === 'password-updated')
                    <span class="af-badge af-badge--success af-badge--md">✓ Actualizada</span>
                @endif
            </div>
        </form>
    </div>
</div>
