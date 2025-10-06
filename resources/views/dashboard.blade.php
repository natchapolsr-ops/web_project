<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    @php($user = auth()->user())

    <div class="content-panel">
        <h2>Welcome back, {{ $user->username ?? $user->name }}!</h2>
        <p class="page-hint">Manage your account, keep up with fresh releases, and explore everything in one spot.</p>

        <div class="button-row">
            <a class="theme-btn" href="{{ url('/movie') }}">Browse movies</a>
            <a class="theme-btn" href="{{ route('profile.show') }}">Edit profile</a>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>
            <div class="info-card">
                <span>Username</span>
                <strong>{{ $user->username ?? 'N/A' }}</strong>
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
</x-app-layout>



