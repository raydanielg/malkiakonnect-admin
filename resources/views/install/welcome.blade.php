@extends('install.layout')

@section('content')
    <h2>Welcome</h2>
    <p>Karibu kwenye installation ya {{ config('app.name') }}. Wizard hii itakusaidia ku-check requirements, kuunganisha database, kuweka site settings, na kuunda admin account.</p>

    <div class="grid" style="margin-top:14px">
        <div class="panel">
            <div style="font-weight:800">What you will set up</div>
            <ul style="margin:10px 0 0; padding-left:18px; color:rgba(234,240,255,.78)">
                <li>Server requirements</li>
                <li>Database connection</li>
                <li>Site name, URL, timezone</li>
                <li>Admin user</li>
            </ul>
        </div>
        <div class="panel">
            <div style="font-weight:800">Before you start</div>
            <p class="small" style="margin-top:10px">Hakikisha una access ya kuandika kwenye file <strong>.env</strong> na folders <strong>storage</strong> + <strong>bootstrap/cache</strong>.</p>
        </div>
    </div>

    <div class="actions">
        <a class="btn primary" href="{{ route('install.requirements') }}">Start Installation</a>
        <a class="btn ghost" href="{{ url('/') }}">Back to Home</a>
    </div>
@endsection
