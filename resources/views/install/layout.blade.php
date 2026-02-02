<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Installation</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            :root{--bg:#0b1020;--card:#101a35;--text:#eaf0ff;--muted:rgba(234,240,255,.75);--accent:#7c5cff;--ok:#22c55e;--bad:#ef4444;--line:rgba(255,255,255,.10)}
            *{box-sizing:border-box} body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;background:radial-gradient(1100px 600px at 10% 15%, rgba(124,92,255,.32), transparent 60%),radial-gradient(900px 520px at 90% 30%, rgba(34,197,94,.20), transparent 55%),var(--bg);color:var(--text)}
            a{color:inherit} .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:28px}
            .shell{width:min(980px,100%)}
            .brand{display:flex;align-items:center;justify-content:space-between;gap:16px;margin:0 0 12px}
            .logo{display:flex;align-items:center;gap:12px}
            .mark{width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg, rgba(124,92,255,1), rgba(124,92,255,.55));box-shadow:0 18px 40px rgba(0,0,0,.35)}
            .title h1{margin:0;font-size:18px;letter-spacing:.2px}
            .title p{margin:2px 0 0;color:var(--muted);font-size:13px}
            .card{background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));border:1px solid var(--line);border-radius:18px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.45)}
            .topbar{display:flex;gap:12px;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid var(--line)}
            .steps{display:flex;flex-wrap:wrap;gap:10px}
            .step{display:inline-flex;align-items:center;gap:8px;padding:8px 10px;border-radius:999px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.18);font-size:12px;color:var(--muted)}
            .step.active{border-color:rgba(124,92,255,.55);background:rgba(124,92,255,.16);color:var(--text)}
            .step .n{width:18px;height:18px;border-radius:999px;display:inline-flex;align-items:center;justify-content:center;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:var(--text);font-weight:700;font-size:11px}
            .body{padding:18px 16px 20px}
            h2{margin:0 0 8px;font-size:20px}
            p{margin:8px 0;color:var(--muted);line-height:1.6}
            .grid{display:grid;grid-template-columns:1fr;gap:14px}
            @media (min-width: 860px){.grid{grid-template-columns:1fr 1fr}}
            .panel{background:rgba(16,26,53,.55);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:14px}
            .row{display:grid;gap:8px;margin-top:10px}
            label{font-size:12px;color:rgba(234,240,255,.78);font-weight:700}
            input,select{width:100%;padding:12px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.25);color:var(--text);outline:none}
            input:focus,select:focus{border-color:rgba(124,92,255,.6);box-shadow:0 0 0 4px rgba(124,92,255,.15)}
            .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:14px}
            .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:12px;text-decoration:none;font-weight:800;border:1px solid rgba(255,255,255,.14);cursor:pointer}
            .btn.primary{background:linear-gradient(135deg, rgba(124,92,255,1), rgba(124,92,255,.72));color:white}
            .btn.ghost{background:rgba(255,255,255,.06);color:var(--text)}
            .alert{border-radius:14px;padding:12px 12px;border:1px solid rgba(255,255,255,.12);margin-bottom:12px}
            .alert.ok{border-color:rgba(34,197,94,.45);background:rgba(34,197,94,.10)}
            .alert.bad{border-color:rgba(239,68,68,.45);background:rgba(239,68,68,.10)}
            .small{font-size:12px;color:rgba(234,240,255,.68)}
            .list{display:grid;gap:10px;margin:12px 0 0;padding:0;list-style:none}
            .item{display:flex;justify-content:space-between;gap:12px;padding:10px 10px;border-radius:12px;border:1px solid rgba(255,255,255,.10);background:rgba(0,0,0,.20)}
            .pill{font-size:12px;font-weight:800;padding:6px 10px;border-radius:999px;border:1px solid rgba(255,255,255,.12)}
            .pill.ok{color:rgba(224,255,236,1);border-color:rgba(34,197,94,.5);background:rgba(34,197,94,.12)}
            .pill.bad{color:rgba(255,226,226,1);border-color:rgba(239,68,68,.5);background:rgba(239,68,68,.12)}
        </style>
    @endif
</head>
<body>
<div class="wrap">
    <div class="shell">
        <div class="brand">
            <div class="logo">
                <div class="mark"></div>
                <div class="title">
                    <h1>{{ config('app.name') }}</h1>
                    <p>Setup Wizard</p>
                </div>
            </div>
            <div class="small">{{ url('/') }}</div>
        </div>

        <div class="card">
            <div class="topbar">
                <div class="steps">
                    @php
                        $steps = [
                            ['key' => 'welcome', 'label' => 'Welcome'],
                            ['key' => 'requirements', 'label' => 'Requirements'],
                            ['key' => 'database', 'label' => 'Database'],
                            ['key' => 'settings', 'label' => 'Settings'],
                            ['key' => 'admin', 'label' => 'Admin'],
                            ['key' => 'finish', 'label' => 'Finish'],
                        ];
                    @endphp

                    @foreach ($steps as $i => $s)
                        <div class="step {{ ($step ?? '') === $s['key'] ? 'active' : '' }}">
                            <span class="n">{{ $i + 1 }}</span>
                            <span>{{ $s['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="body">
                @if (session('install_error'))
                    <div class="alert bad">{{ session('install_error') }}</div>
                @endif

                @if (session('install_success'))
                    <div class="alert ok">{{ session('install_success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert bad">
                        <div style="font-weight:800;margin-bottom:6px">Please fix the following:</div>
                        <ul style="margin:0;padding-left:18px;color:rgba(255,226,226,1)">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <div class="small" style="margin-top:12px; text-align:center">Installer will create admin user and write configuration to <span style="color:rgba(234,240,255,.82)">.env</span></div>
    </div>
</div>
</body>
</html>
