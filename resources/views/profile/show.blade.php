<x-app-layout>
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    @php($user = auth()->user())

    <div class="content-panel">
        <h2>Your profile hub</h2>
        <p class="page-hint">Keep personal details, security, and account preferences up to date.</p>
        <div class="info-grid">
            <div class="info-card">
                <span>Username</span>
                <strong>{{ $user->username ?? 'N/A' }}</strong>
            </div>
            <div class="info-card">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>
            <div class="info-card">
                <span>Age</span>
                <strong>{{ $user->age ?? 'N/A' }}</strong>
            </div>
            <div class="info-card">
                <span>Member since</span>
                <strong>{{ $user->created_at?->format('d M Y') }}</strong>
            </div>
        </div>
    </div>

    <div class="profile-sections">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="profile-card">
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="profile-card">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="profile-card">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <div class="profile-card">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="profile-card">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</x-app-layout>


