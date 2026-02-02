<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Login</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root{--bg:#0b1220;--panel:#0f1a2e;--panel2:#0c1628;--card:#111c33;--text:#e7f0ff;--muted:rgba(231,240,255,.72);--line:rgba(255,255,255,.10);--green:#22c55e;--green2:#16a34a;--shadow:0 24px 80px rgba(0,0,0,.55)}
        *{box-sizing:border-box}
        body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;background:radial-gradient(900px 620px at 15% 20%, rgba(34,197,94,.22), transparent 60%),radial-gradient(800px 520px at 90% 25%, rgba(34,197,94,.10), transparent 55%),linear-gradient(180deg, #0a1020, var(--bg));color:var(--text)}
        a{color:inherit}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:22px}
        .shell{width:min(1080px,100%);display:grid;grid-template-columns:1fr;gap:16px}
        @media (min-width: 980px){.shell{grid-template-columns:1.05fr .95fr;gap:0;border-radius:18px;overflow:hidden;border:1px solid var(--line);box-shadow:var(--shadow);background:rgba(255,255,255,.04)}}
        .left{padding:28px 22px;border:1px solid var(--line);border-radius:18px;background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));box-shadow:var(--shadow)}
        @media (min-width: 980px){.left{border:none;border-radius:0;box-shadow:none;background:linear-gradient(180deg, rgba(255,255,255,.05), rgba(255,255,255,.03))}}
        .right{padding:28px 22px;border:1px solid var(--line);border-radius:18px;background:linear-gradient(180deg, rgba(17,28,51,.90), rgba(12,22,40,.90));box-shadow:var(--shadow)}
        @media (min-width: 980px){.right{border:none;border-left:1px solid var(--line);border-radius:0;box-shadow:none;background:linear-gradient(180deg, rgba(17,28,51,.75), rgba(12,22,40,.75))}}

        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg, rgba(34,197,94,1), rgba(22,163,74,.7));box-shadow:0 16px 44px rgba(0,0,0,.45)}
        .brand-title{font-weight:900;letter-spacing:.3px}
        .brand-sub{font-size:12px;color:rgba(231,240,255,.68)}

        h1{margin:18px 0 8px;font-size:clamp(28px, 3.4vw, 44px);line-height:1.08}
        p{margin:8px 0;color:var(--muted);line-height:1.6}
        .feature{display:flex;gap:10px;margin-top:14px}
        .dot{margin-top:3px;width:18px;height:18px;border-radius:6px;background:rgba(34,197,94,.18);border:1px solid rgba(34,197,94,.35);display:flex;align-items:center;justify-content:center}
        .dot:before{content:"";width:8px;height:8px;border-radius:999px;background:var(--green)}
        .ft-title{font-weight:900;font-size:14px}
        .ft-desc{font-size:12px;color:rgba(231,240,255,.68);margin-top:2px}
        .footer-links{display:flex;gap:14px;flex-wrap:wrap;font-size:12px;color:rgba(231,240,255,.62);margin-top:22px}

        .card-title{font-weight:900;font-size:20px}
        .divider{display:flex;align-items:center;gap:10px;margin:16px 0}
        .divider:before,.divider:after{content:"";flex:1;height:1px;background:rgba(255,255,255,.10)}
        .divider span{font-size:12px;color:rgba(231,240,255,.55)}

        label{font-size:12px;color:rgba(231,240,255,.78);font-weight:900}
        .row{display:grid;gap:8px;margin-top:12px}
        input{width:100%;padding:12px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.22);color:var(--text);outline:none}
        input:focus{border-color:rgba(34,197,94,.65);box-shadow:0 0 0 4px rgba(34,197,94,.18)}

        .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:12px;text-decoration:none;font-weight:900;border:1px solid rgba(255,255,255,.14);cursor:pointer;width:100%}
        .btn-primary{background:linear-gradient(135deg, rgba(34,197,94,1), rgba(22,163,74,.88));color:#062013}
        .btn-primary:hover{filter:brightness(1.03)}
        .btn-secondary{background:rgba(255,255,255,.06);color:var(--text)}
        .btn-secondary:hover{background:rgba(255,255,255,.08)}

        .small{font-size:12px;color:rgba(231,240,255,.62)}
        .error{margin-top:10px;border:1px solid rgba(255,255,255,.12);background:rgba(239,68,68,.12);border-color:rgba(239,68,68,.45);padding:10px 10px;border-radius:12px;color:rgba(255,226,226,1)}
    </style>
</head>
<body>
<div class="wrap">
    <div class="shell">
        <div class="left">
            <div class="brand">
                <div class="logo"></div>
                <div>
                    <div class="brand-title">{{ config('app.name') }}</div>
                    <div class="brand-sub">Admin Portal</div>
                </div>
            </div>

            <h1>Get started quickly</h1>
            <p>Ingia kwenye mfumo kuendelea na kazi zako. Muonekano huu umeboreshwa kwa web na mobile.</p>

            <div class="feature">
                <div class="dot"></div>
                <div>
                    <div class="ft-title">Fast & secure access</div>
                    <div class="ft-desc">Session-based login na ulinzi wa rate-limit.</div>
                </div>
            </div>

            <div class="feature">
                <div class="dot"></div>
                <div>
                    <div class="ft-title">Support any device</div>
                    <div class="ft-desc">Inafanya vizuri kwenye simu na desktop.</div>
                </div>
            </div>

            <div class="feature">
                <div class="dot"></div>
                <div>
                    <div class="ft-title">Reliable dashboard</div>
                    <div class="ft-desc">Baada ya ku-login utaelekezwa kwenye dashboard.</div>
                </div>
            </div>

            <div class="footer-links">
                <span>About</span>
                <span>Terms &amp; Conditions</span>
                <span>Contact</span>
            </div>
        </div>

        <div class="right">
            <div class="card-title">Sign in to your account</div>
            <p class="small" style="margin-top:6px">Tumia email na password yako kuingia.</p>

            @if ($errors->any())
                <div class="error">
                    <div style="font-weight:900;margin-bottom:6px">Please fix:</div>
                    <ul style="margin:0;padding-left:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row" style="grid-template-columns:1fr 1fr; gap:10px; margin-top:14px">
                <button type="button" class="btn btn-secondary">Continue with Google</button>
                <button type="button" class="btn btn-secondary">Continue with Apple</button>
            </div>

            <div class="divider"><span>or</span></div>

            <form method="POST" action="{{ route('auth.login.submit') }}" style="margin-top:12px">
                @csrf

                <div class="row">
                    <label>Email</label>
                    <input name="email" value="{{ old('email') }}" placeholder="admin@example.com" autocomplete="email" autofocus>
                </div>

                <div class="row">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="********" autocomplete="current-password">
                </div>

                <div class="row" style="grid-template-columns:auto 1fr; align-items:center">
                    <input id="remember" type="checkbox" name="remember" value="1" style="width:18px;height:18px">
                    <label for="remember" style="font-weight:700">Remember me</label>
                </div>

                <div class="row">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
