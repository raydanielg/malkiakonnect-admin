@extends('install.layout')

@section('content')
    <h2>Finish</h2>
    <p>Confirm kila kitu kipo sawa, kisha maliza installation.</p>

    <div class="grid" style="margin-top:14px">
        <div class="panel">
            <div style="font-weight:800">Checklist</div>
            <ul class="list" style="margin-top:10px">
                <li class="item">
                    <div>
                        <div style="font-weight:800">Requirements</div>
                        <div class="small">Server extensions & permissions</div>
                    </div>
                    <div class="pill {{ ($requirements['ok'] ?? false) ? 'ok' : 'bad' }}">{{ ($requirements['ok'] ?? false) ? 'OK' : 'Fix' }}</div>
                </li>
                <li class="item">
                    <div>
                        <div style="font-weight:800">Database</div>
                        <div class="small">Connection details provided</div>
                    </div>
                    <div class="pill {{ $hasDb ? 'ok' : 'bad' }}">{{ $hasDb ? 'OK' : 'Missing' }}</div>
                </li>
                <li class="item">
                    <div>
                        <div style="font-weight:800">Settings</div>
                        <div class="small">Site name, URL, timezone</div>
                    </div>
                    <div class="pill {{ $hasSettings ? 'ok' : 'bad' }}">{{ $hasSettings ? 'OK' : 'Missing' }}</div>
                </li>
                <li class="item">
                    <div>
                        <div style="font-weight:800">Admin</div>
                        <div class="small">Admin credentials provided</div>
                    </div>
                    <div class="pill {{ $hasAdmin ? 'ok' : 'bad' }}">{{ $hasAdmin ? 'OK' : 'Missing' }}</div>
                </li>
            </ul>
        </div>

        <div class="panel">
            <div style="font-weight:800">What will happen</div>
            <ul style="margin:10px 0 0; padding-left:18px; color:rgba(234,240,255,.78)">
                <li>Write settings to <strong>.env</strong></li>
                <li>Run database migrations</li>
                <li>Create/Update admin user</li>
                <li>Create installed flag</li>
            </ul>
            <div class="small" style="margin-top:10px">Baada ya kumaliza, installer route itafungwa automatically (utakuwa una-redirect kwenye site).</div>
        </div>
    </div>

    <form method="POST" action="{{ route('install.finish.save') }}" style="margin-top:14px">
        @csrf
        <div class="actions">
            <button class="btn primary" type="submit">Complete Installation</button>
            <a class="btn ghost" href="{{ route('install.admin') }}">Back</a>
        </div>
    </form>
@endsection
