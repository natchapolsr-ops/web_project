<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <style>
        :root{
            --maroon:#7b1012;
            --maroon-dark:#640b0c;
            --bg:#222326;
        }
        html,body{height:100%;margin:0;font-family:'Segoe UI',Roboto,Arial,sans-serif;background:var(--bg);color:#fff}
        /* top bar */
        .topbar{height:64px;background:var(--maroon);border-bottom:4px solid #5a2a6e;display:flex;align-items:center;justify-content:space-between;padding:0 20px}
        .menu-left{display:flex;gap:20px;align-items:center;margin-left:12px}
        .menu-left a{color:#fff;text-decoration:none;font-size:18px}

        main{min-height:calc(100% - 144px);display:flex;align-items:center;justify-content:center;padding:20px}
        .panel{width:520px;max-width:90%;text-align:center}

        h1{font-size:36px;margin:0 0 24px;color:#fff;text-shadow:0 2px 0 rgba(0,0,0,.7)}

        .form{background:transparent;padding:10px}
        .input{display:block;margin:12px auto;width:320px;max-width:86%;height:40px;border-radius:24px;background:var(--maroon);border:none;color:#fff;text-align:center;font-size:16px;box-shadow:0 4px 0 rgba(0,0,0,0.3);}
        .input::placeholder{color:rgba(255,255,255,0.9)}

        .btn{display:inline-block;margin-top:12px;padding:8px 36px;border-radius:20px;background:var(--maroon-dark);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 0 rgba(0,0,0,0.4)}

        /* bottom bar with seats effect */
        .bottombar{height:80px;background:var(--maroon);position:relative;overflow:hidden}
        .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg,#a32024 0 40px,#7b1012 40px 80px);transform:skewY(-2deg);}

        /* responsive tweaks */
        @media(max-width:420px){.input{width:260px}}

        /* Error message styling */
        .error{color:#ffaaaa;margin:4px 0;font-size:14px}
    </style>
</head>
<body>
    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ url('/login') }}">login</a>
        </div>
    </div>

    <main>
        <div class="panel">
            <h1>Register</h1>

            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <input type="text" name="mail" class="input" placeholder="Email" value="{{ old('mail') }}" required>
                <input type="text" name="username" class="input" placeholder="Username" value="{{ old('username') }}" required>
                <input type="number" name="age" class="input" placeholder="Age" value="{{ old('age') }}" required>
                <input type="password" name="password" class="input" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password" required>
                
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </main>

    <div class="bottombar">
        <div class="seats"></div>
    </div>
</body>
</html>

