<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $movie['title'] }} - Detail</title>
    <style>
        :root{--maroon:#7b1012;--bg:#222;--accent:#5a2a6e}
    body{margin:0;background:var(--bg);color:#fff;font-family:Arial,Helvetica,sans-serif;padding-bottom:96px}
        .topbar{height:88px;background:var(--maroon);border-bottom:4px solid var(--accent);display:flex;align-items:center;padding:0 28px}
        .menu-left{display:flex;gap:22px}
        .menu-left a{color:#fff;text-decoration:none;font-size: 18px}
        .hamburger{margin-left:auto;width:36px;height:24px;display:flex;flex-direction:column;justify-content:space-between}
        .hamburger span{display:block;height:3px;background:#fff;border-radius:3px}

        .wrap{padding:36px;max-width:1000px;margin:0 auto}
        .detail{display:flex;gap:40px;align-items:flex-start}
        .poster{width:170px;height:220px;object-fit:cover;border:8px solid rgba(0,0,0,0.4);background:#111}
        .meta{flex:1}
        .date{color:#d9b84b;font-weight:600;margin-bottom:10px}
        .title{font-size:20px;font-weight:700;margin-bottom:8px}
        .time-badge{display:inline-block;background:#d9b184;color:#111;padding:8px 14px;border-radius:8px;margin-left:12px}
        .genre{color:#ccc;margin-top:10px}

        .syn{margin-top:24px;color:#ddd;line-height:1.6}

    /* fixed bottom bar so it always touches the viewport bottom */
    .bottombar{height:96px;background:var(--maroon);position:fixed;left:0;right:0;bottom:0}
    .seats{position:absolute;left:0;right:0;bottom:18px;height:36px;background:repeating-linear-gradient(90deg,#a32024 0 60px,#7b1012 60px 120px);}
    .page-num{position:absolute;right:18px;bottom:8px;font-size:32px;color:#080000}

        @media(max-width:800px){.detail{flex-direction:column;align-items:center}.poster{width:220px;height:280px}}
    </style>
</head>
<body>
    <div class="topbar">
        <div class="menu-left">
            <a href="{{ url('/movie') }}">Home</a>
            <a href="{{ url('/about') }}">login</a>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="wrap">
        <div class="detail">
            <img class="poster" src="{{ $movie['poster'] }}" alt="Poster">
            <div class="meta">
                <div style="display:flex;align-items:center;gap:20px">
                    <div>
                        <div class="date">{{ $movie['date'] }}</div>
                        <div class="title">{{ $movie['title'] }}</div>
                        <div class="genre">{{ $movie['genre'] }}</div>
                    </div>
                    <div style="margin-left:auto">
                        <div class="time-badge">{{ $movie['time'] }}</div>
                    </div>
                </div>

                <h4 style="margin-top:28px;color:#ddd">เรื่องย่อ</h4>
                <div class="syn">{!! nl2br(e($movie['synopsis'])) !!}</div>
            </div>
        </div>
    </div>

    <div class="bottombar">
        <div class="seats"></div>
    </div>
</body>
</html>
