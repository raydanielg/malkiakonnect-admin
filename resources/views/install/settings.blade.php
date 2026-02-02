@extends('install.layout')

@section('content')
    <h2>Site Settings</h2>
    <p>Weka taarifa za app yako. Hizi zitaandikwa kwenye <strong>.env</strong>.</p>

    <form method="POST" action="{{ route('install.settings.save') }}">
        @csrf

        <div class="grid" style="margin-top:14px">
            <div class="panel">
                <div class="row">
                    <label>Site Name</label>
                    <input name="app_name" value="{{ $data['app_name'] ?? '' }}" placeholder="Malkia Konnect">
                </div>

                <div class="row">
                    <label>App URL</label>
                    <input name="app_url" value="{{ $data['app_url'] ?? '' }}" placeholder="https://example.com">
                </div>
            </div>

            <div class="panel">
                <div class="row">
                    <label>Timezone</label>
                    <input name="app_timezone" value="{{ $data['app_timezone'] ?? '' }}" placeholder="Africa/Nairobi">
                    <div class="small">Mfano: <strong>Africa/Nairobi</strong>, <strong>UTC</strong></div>
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="btn primary" type="submit">Continue</button>
            <a class="btn ghost" href="{{ route('install.database') }}">Back</a>
        </div>
    </form>
@endsection
