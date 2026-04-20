<div class="af-form-section af-form-section--danger">
    <div class="af-form-section__header af-form-section__header--danger">
        <span class="af-form-section__step af-form-section__step--danger">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </span>
        <span class="af-form-section__title af-form-section__title--danger">Eliminar cuenta</span>
    </div>

    <div class="af-form-section__body">
        <p class="af-form-section__desc">
            Al eliminar tu cuenta se borrarán permanentemente todos tus datos, automatizaciones e historial de ejecuciones.
            Esta acción <strong>no se puede deshacer</strong>.
        </p>

        <button type="button" class="af-btn af-btn--danger af-btn--sm" id="af-show-delete-btn">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Eliminar mi cuenta
        </button>

        {{-- Confirmación expandible (oculta por defecto) --}}
        <div id="af-delete-confirm" class="af-delete-confirm">
            <div class="af-alert af-alert--danger af-alert--mb">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Para confirmar, ingresa tu contraseña actual.
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" novalidate>
                @csrf
                @method('delete')

                <div class="af-field">
                    <label for="del_password" class="af-label">Contraseña actual</label>
                    <div class="af-input-group">
                        <svg class="af-input-group__icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input id="del_password" type="password" name="password"
                               placeholder="Tu contraseña"
                               class="af-input {{ $errors->userDeletion->has('password') ? 'af-input--error' : '' }}"/>
                    </div>
                    @if ($errors->userDeletion->has('password'))
                        <p class="af-field-error">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="af-btn-group">
                    <button type="submit" class="af-btn af-btn--danger af-btn--sm">
                        Confirmar eliminación
                    </button>
                    <button type="button" class="af-btn af-btn--secondary af-btn--sm" id="af-cancel-delete-btn">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
