<x-guest-layout>

    <div style="text-align: center; margin-bottom: 28px;">
        {{-- Icono de email --}}
        <div style="width: 68px; height: 68px; background: var(--af-primary-lighter); border-radius: var(--af-radius-xl); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="#2563EB" stroke-width="1.6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--af-text-dark); letter-spacing: -0.4px; margin: 0 0 8px;">
            Verifica tu correo
        </h1>
        <p style="font-size: 0.9rem; color: var(--af-text-muted); line-height: 1.6; max-width: 340px; margin: 0 auto;">
            Hemos enviado un enlace de verificación a tu correo electrónico.
            Revisa tu bandeja de entrada y haz clic en el enlace para activar tu cuenta.
        </p>
    </div>

    {{-- Aviso de éxito si se reenvió --}}
    @if (session('status') == 'verification-link-sent')
        <div class="af-alert af-alert--success" style="margin-bottom: 20px;">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            El enlace de verificación ha sido reenviado.
        </div>
    @endif

    {{-- Reenviar --}}
    <form method="POST" action="{{ route('verification.send') }}" style="margin-bottom: 16px;">
        @csrf
        <button type="submit" class="af-btn af-btn--primary af-btn--full af-btn--lg">
            Reenviar correo de verificación
        </button>
    </form>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="af-btn af-btn--secondary af-btn--full">
            Cerrar sesión
        </button>
    </form>

</x-guest-layout>
