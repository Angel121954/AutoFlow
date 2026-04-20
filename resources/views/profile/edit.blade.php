<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/app/automations.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app/profile.css') }}">
    @endpush

    @slot('breadcrumb')
        <a href="{{ route('dashboard') }}" class="af-breadcrumb-link">Inicio</a>
        <span>›</span>
        <strong>Mi Perfil</strong>
    @endslot

    <div class="af-page-header">
        <div class="af-page-header__title">
            <h1>Mi Perfil</h1>
            <p>Gestiona tu información personal y seguridad</p>
        </div>
    </div>

    <div class="af-profile-container">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>

    @push('scripts')
        <script src="{{ asset('js/app/profile.js') }}"></script>
    @endpush

</x-app-layout>
