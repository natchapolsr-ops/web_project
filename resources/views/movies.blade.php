<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>
    <style>
        :root{--maroon:#7b1012;--bg:#222;--accent:#5a2a6e}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:#fff;font-family:Arial,Helvetica,sans-serif}
    .topbar{background:var(--maroon);height:88px;padding:18px 28px;border-bottom:4px solid var(--accent);display:flex;align-items:center}
    .menu-left, .menu-right{display:flex;gap:22px;align-items:center}
    .menu-left a, .menu-right a{color:#fff;text-decoration:none;font-size:18px}

    /* Hamburger (three lines) */
    .hamburger{width:36px;height:24px;display:flex;flex-direction:column;justify-content:space-between;cursor:pointer;background:transparent;border:none;padding:0}
    .hamburger span{display:block;height:3px;background:#fff;border-radius:3px}
    .hamburger:focus{outline:2px solid rgba(255,255,255,0.15);outline-offset:3px}

        .container{padding:20px 36px}

    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:28px}
    .card-link{display:block;text-decoration:none;color:inherit}
    .card{background:#2b2b2b;padding:12px;border-radius:4px;text-align:center}
        .poster{width:140px;height:200px;object-fit:cover;display:block;margin:0 auto 8px;border:6px solid rgba(0,0,0,0.4)}
        .card h4{margin:6px 0 2px;font-size:14px}
        .card small{display:block;color:#cfcfcf}

        .section-title{color:#b32b2b;font-size:24px;margin:16px 0}

        .bottombar{height:96px;background:var(--maroon);position:relative;margin-top:36px}
        .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg,#a32024 0 60px,#7b1012 60px 120px);}
        .page-num{position:absolute;left:28px;bottom:8px;font-size:32px;color:#080000}

        .pagination{position:absolute;right:18px;bottom:18px;background:#fff;padding:6px;border-radius:6px}
        .pagination span{background:#eee;padding:6px 8px;margin:0 4px;border-radius:4px;color:#333}

        @media (max-width:640px){.poster{width:120px;height:170px}}
    </style>
</head>
<body>
    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ url('/login') }}">login</a>
        </div>

        <div style="flex:1"></div>

        <div class="menu-right">
            <button class="hamburger" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="grid">
            @foreach($movies as $movie)
            <a href="{{ route('movie.show', $movie['id']) }}" class="card-link">
                <div class="card">
                    <img class="poster" src="{{ $movie['poster'] }}" alt="Poster">
                    <h4>{{ $movie['title'] ?? 'Movie Name' }}</h4>
                    <small>{{ $movie['date'] ?? $movie['release'] ?? '' }}</small>
                </div>
            </a>
            @endforeach
        </div>

        <h3 class="section-title">Now showing</h3>

        <div class="grid" style="margin-bottom:24px">
            @foreach(array_slice($movies,0,4) as $movie)
            <a href="{{ route('movie.show', $movie['id']) }}" class="card-link">
                <div class="card">
                    <img class="poster" src="{{ $movie['poster'] }}" alt="Poster">
                    <h4>{{ $movie['title'] ?? 'Movie Name' }}</h4>
                    <small>{{ $movie['date'] ?? $movie['release'] ?? '' }}</small>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="bottombar">
        <div class="seats"></div>
        
        </div>
    </div>
</body>
</html>
