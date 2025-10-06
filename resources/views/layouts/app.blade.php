<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles

    <style>
        :root{
            --maroon:#7b1012;
            --maroon-dark:#640b0c;
            --bg:#222326;
            --panel:#2a2b30;
            --text-soft:#f0eaff;
        }
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;display:flex;flex-direction:column;background:var(--bg);color:var(--text-soft);font-family:'Segoe UI',Roboto,Arial,sans-serif}
        a{color:inherit;text-decoration:none}
        .topbar{height:64px;background:var(--maroon);border-bottom:4px solid #5a2a6e;display:flex;align-items:center;justify-content:space-between;padding:0 24px}
        .menu-left{display:flex;gap:20px;align-items:center}
        .menu-left a{font-size:18px;color:#fff;transition:opacity .2s ease}
        .menu-left a:hover{opacity:0.8}
        .menu-right{display:flex;align-items:center;gap:16px}
        .user-chip{background:rgba(0,0,0,0.25);padding:6px 16px;border-radius:20px;font-size:15px;color:#fff}
        .logout-form{display:inline}
        .logout-btn{background:var(--maroon-dark);color:#fff;border:none;border-radius:18px;padding:8px 20px;cursor:pointer;box-shadow:0 4px 0 rgba(0,0,0,0.35);font-size:15px;transition:transform .2s ease,box-shadow .2s ease}
        .logout-btn:hover{transform:translateY(-1px);box-shadow:0 6px 0 rgba(0,0,0,0.4)}
        main{flex:1;display:flex;justify-content:center;padding:40px 20px}
        .content-container{width:100%;max-width:1100px;display:flex;flex-direction:column;gap:28px}
        .page-title{font-size:32px;font-weight:600;text-transform:uppercase;letter-spacing:1px;text-shadow:0 2px 0 rgba(0,0,0,0.6);padding:0 6px}
        .content-panel{background:rgba(0,0,0,0.35);border-radius:28px;padding:32px 36px;box-shadow:0 18px 35px rgba(0,0,0,0.45);border:1px solid rgba(255,255,255,0.08)}
        .content-panel h2,.content-panel h3{color:var(--text-soft);margin-top:0;text-shadow:0 2px 0 rgba(0,0,0,0.35)}
        .content-panel p{color:rgba(255,255,255,0.85);line-height:1.6}
        .button-row{display:flex;flex-wrap:wrap;gap:12px;margin-top:24px}
        .theme-btn{background:var(--maroon-dark);color:#fff;padding:10px 26px;border:none;border-radius:22px;cursor:pointer;transition:transform .2s ease,box-shadow .2s ease;box-shadow:0 6px 0 rgba(0,0,0,0.4);font-size:15px}
        .theme-btn:hover{transform:translateY(-2px);box-shadow:0 10px 0 rgba(0,0,0,0.45)}
        .info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-top:24px}
        .info-card{padding:20px;border-radius:20px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12)}
        .info-card span{display:block;font-size:14px;opacity:0.75;margin-bottom:6px}
        .info-card strong{font-size:20px}
        .profile-sections{display:flex;flex-direction:column;gap:26px}
        .profile-card{background:rgba(0,0,0,0.45);border-radius:24px;padding:24px 28px;border:1px solid rgba(255,255,255,0.12);box-shadow:0 16px 28px rgba(0,0,0,0.45)}
        .profile-card .bg-white,.profile-card .bg-gray-50{background:transparent !important}
        .profile-card .text-gray-800,.profile-card .text-gray-700,.profile-card .text-gray-600,.profile-card .text-gray-500{color:var(--text-soft) !important}
        .profile-card label{color:var(--text-soft);font-weight:600}
        .profile-card input,.profile-card select,.profile-card textarea{width:100%;background:rgba(123,16,18,0.55);border:1px solid rgba(255,255,255,0.25);color:#fff;border-radius:18px;padding:10px 16px;box-shadow:0 4px 0 rgba(0,0,0,0.35)}
        .profile-card input:focus,.profile-card select:focus,.profile-card textarea:focus{outline:none;border-color:rgba(255,255,255,0.6);box-shadow:0 0 0 2px rgba(255,255,255,0.3)}
        .profile-card button{background:var(--maroon-dark);border:none;border-radius:20px;padding:10px 22px;color:#fff;font-weight:600;cursor:pointer;box-shadow:0 6px 0 rgba(0,0,0,0.4)}
        .profile-card button:hover{transform:translateY(-1px)}
        .bottombar{height:80px;background:var(--maroon);position:relative;overflow:hidden;margin-top:auto}
        .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg,#a32024 0 40px,#7b1012 40px 80px);transform:skewY(-2deg)}
        .page-hint{font-size:16px;opacity:0.8}
        .divider{height:1px;background:rgba(255,255,255,0.15);margin:18px 0}
        @media (max-width:768px){
            .topbar{flex-wrap:wrap;gap:12px;height:auto;padding:16px}
            .menu-left{width:100%;justify-content:center;flex-wrap:wrap}
            .menu-right{width:100%;justify-content:center}
            main{padding:28px 16px}
            .content-panel{padding:24px}
            .profile-card{padding:20px}
        }
    </style>
</head>
<body>
    <x-banner />

    @php($authUser = auth()->user())

    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('profile.show') }}">Profile</a>
        </div>
        <div class="menu-right">
            <div class="user-chip">{{ $authUser->username ?? $authUser->name }}</div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <main>
        <div class="content-container">
            @if (isset($header))
                <div class="page-title">{{ $header }}</div>
            @endif

            {{ $slot }}
        </div>
    </main>

    <div class="bottombar">
        <div class="seats"></div>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

