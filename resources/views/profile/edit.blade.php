<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
    @endpush

    @slot('breadcrumb')
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: var(--af-text-muted);">Inicio</a>
        <span>›</span>
        <strong>Mi Perfil</strong>
    @endslot

    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Mi Perfil</h1>
            <p>Gestiona tu información personal y seguridad</p>
        </div>
    </div>

    <div style="max-width: 700px; display: flex; flex-direction: column; gap: 20px;">

        {{-- ── Información del perfil ── --}}
        @include('profile.partials.update-profile-information-form')

        {{-- ── Cambiar contraseña ── --}}
        @include('profile.partials.update-password-form')

        {{-- ── Eliminar cuenta ── --}}
        @include('profile.partials.delete-user-form')

    </div>

</x-app-layout>
