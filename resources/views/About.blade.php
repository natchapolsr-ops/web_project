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
        html,body{height:100%;margin:0;font-family: 'Segoe UI', Roboto, Arial, sans-serif;background:var(--bg);color:#fff}
    /* top bar */
    .topbar{height:64px;background:var(--maroon);border-bottom:4px solid #5a2a6e;display:flex;align-items:center;justify-content:space-between;padding:0 20px}
    .menu-left{display:flex;gap:20px;align-items:center;margin-left:12px}
    .menu-left a{color:#fff;text-decoration:none;font-size:18px}
    .hamburger{width:34px;height:22px;display:flex;flex-direction:column;justify-content:space-between;margin-right:8px}
    .hamburger span{display:block;height:2px;background:#fff;border-radius:2px}

        main{min-height:calc(100% - 144px);display:flex;align-items:center;justify-content:center;padding:20px}
        .panel{width:520px;max-width:90%;text-align:center}

        h1{font-size:36px;margin:0 0 24px;color:#fff;text-shadow:0 2px 0 rgba(0,0,0,.7)}

        .form{background:transparent;padding:10px}
        .input{display:block;margin:12px auto;width:320px;max-width:86%;height:40px;border-radius:24px;background:var(--maroon);border:none;color:#fff;text-align:center;font-size:16px;box-shadow:0 4px 0 rgba(0,0,0,0.3);}
        .input::placeholder{color:rgba(255,255,255,0.9)}

        .btn{display:inline-block;margin-top:12px;padding:8px 36px;border-radius:20px;background:var(--maroon-dark);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 0 rgba(0,0,0,0.4)}

        .help{margin-top:18px;color:#9fbfe3}
        .help a{color:#2ea0ff;text-decoration:underline}

        /* bottom decorative bar with 'seats' effect */
        .bottombar{height:80px;background:var(--maroon);position:relative;overflow:hidden}
        .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg, #a32024 0 40px, #7b1012 40px 80px);transform:skewY(-2deg);}
        .page-number{position:absolute;right:18px;bottom:6px;font-size:28px;color:#0b0000;font-weight:700}

        /* responsive tweaks */
        @media(max-width:420px){.input{width:260px}}
    </style>
</head>
<body>
    
    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ url('/about') }}">login</a>
        </div>

        <div class="hamburger" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <main>
        <div class="panel">
            <h1>Login</h1>

            <form class="form" action="#" method="post" onsubmit="return false;">
                <input class="input" type="text" placeholder="Username" aria-label="Username">
                <input class="input" type="password" placeholder="Password" aria-label="Password">
                <button class="btn">Login</button>
            </form>

            <div class="help">Don't have an account yet? <a href="#">Register</a></div>
        </div>
    </main>

    <div class="bottombar">
        <div class="seats" aria-hidden="true"></div>
    </div>
</body>
</html>
