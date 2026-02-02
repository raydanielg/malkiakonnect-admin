@extends('install.layout')

@section('content')
    <h2>Requirements</h2>
    <p>Hapa tunakagua kama environment yako iko tayari ku-run application.</p>

    <ul class="list">
        @foreach (($requirements['checks'] ?? []) as $c)
            <li class="item">
                <div>
                    <div style="font-weight:800">{{ $c['label'] }}</div>
                    @if (!empty($c['hint']))
                        <div class="small">{{ $c['hint'] }}</div>
                    @endif
                </div>
                <div class="pill {{ $c['ok'] ? 'ok' : 'bad' }}">{{ $c['ok'] ? 'OK' : 'Fix' }}</div>
            </li>
        @endforeach
    </ul>

    <div class="actions">
        @if (($requirements['ok'] ?? false))
            <a class="btn primary" href="{{ route('install.database') }}">Continue</a>
        @else
            <a class="btn primary" href="{{ route('install.requirements') }}">Re-check</a>
        @endif
        <a class="btn ghost" href="{{ route('install.welcome') }}">Back</a>
    </div>
@endsection
