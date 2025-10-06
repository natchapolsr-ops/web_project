<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        :root{
            --maroon:#7b1012;
            --maroon-dark:#640b0c;
            --bg:#222326;
        }
        html,body{height:100%;margin:0;font-family:'Segoe UI',Roboto,Arial,sans-serif;background:var(--bg);color:#fff}
        /* top bar */
        .topbar{height:64px;background:var(--maroon);border-bottom:4px solid #5a2a6e;display:flex;align-items:center;padding:0 20px}
        .menu-left{display:flex;gap:20px;align-items:center}
        .menu-left a{color:#fff;text-decoration:none;font-size:18px}

        main{min-height:calc(100% - 144px);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:20px}
        h1{font-size:36px;margin:0 0 24px;color:#fff;text-shadow:0 2px 0 rgba(0,0,0,.7)}

        .form{background:transparent;padding:10px;display:flex;flex-direction:column;align-items:center;gap:12px;width:100%;max-width:400px}
        .input{width:100%;height:40px;border-radius:24px;background:var(--maroon);border:none;color:#fff;text-align:center;font-size:16px;box-shadow:0 4px 0 rgba(0,0,0,0.3)}
        .input::placeholder{color:rgba(255,255,255,0.9)}

        .btn{display:inline-block;padding:8px 36px;border-radius:20px;background:var(--maroon-dark);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 0 rgba(0,0,0,0.4);font-size:16px}

        .register{margin-top:18px;color:#9fbfe3}
        .register a{color:#2ea0ff;text-decoration:underline}

        /* bottom bar */
        .bottombar{height:80px;background:var(--maroon);position:relative;overflow:hidden}
        .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg,#a32024 0 40px,#7b1012 40px 80px);transform:skewY(-2deg)}
    </style>
</head>
<body>
    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ url('/about') }}">login</a>
        </div>
    </div>

    <main>
        <h1>Login</h1>

        @if($errors->any())
            <div style="color:#ffaaaa;margin-bottom:10px;text-align:center">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <input type="text" name="email" class="input" placeholder="Username" value="{{ old('email') }}" required>
            <input type="password" name="password" class="input" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>

        <div class="register">
            Don't have an account yet? <a href="{{ route('register') }}">Register</a>
        </div>
    </main>

    <div class="bottombar">
        <div class="seats"></div>
    </div>
</body>
</html>
