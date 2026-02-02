<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Dashboard</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            :root{--bg:#0b1020;--card:#101a35;--text:#eaf0ff;--muted:rgba(234,240,255,.75);--accent:#7c5cff;--line:rgba(255,255,255,.10)}
            *{box-sizing:border-box} body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;background:radial-gradient(1100px 600px at 10% 15%, rgba(124,92,255,.32), transparent 60%),radial-gradient(900px 520px at 90% 30%, rgba(34,197,94,.20), transparent 55%),var(--bg);color:var(--text)}
            .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
            .card{width:min(980px,100%);border-radius:18px;overflow:hidden;border:1px solid var(--line);background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));box-shadow:0 20px 60px rgba(0,0,0,.45)}
            .top{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 16px;border-bottom:1px solid rgba(255,255,255,.10)}
            .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:10px 12px;border-radius:12px;text-decoration:none;font-weight:900;border:1px solid rgba(255,255,255,.14);cursor:pointer;background:rgba(255,255,255,.06);color:var(--text)}
            .body{padding:16px}
            .small{font-size:12px;color:rgba(234,240,255,.68)}
        </style>
    @endif
</head>
<body>
<div class="wrap">
    <div class="card">
        <div class="top">
            <div>
                <div style="font-weight:900">Dashboard</div>
                <div class="small">Welcome, {{ auth()->user()->name ?? auth()->user()->email }}</div>
            </div>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button class="btn" type="submit">Logout</button>
            </form>
        </div>
        <div class="body">
            <div style="font-weight:900;font-size:18px">Ready</div>
            <p class="small" style="margin-top:6px">Hii ni landing page ya baada ya login. Unaweza ku-link modules zako hapa (kama Adminmodules).</p>

            <div style="margin-top:12px">
                <a class="btn" href="{{ url('/adminmodules') }}">Open Adminmodules</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
