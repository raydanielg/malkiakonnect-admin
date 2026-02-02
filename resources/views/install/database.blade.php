@extends('install.layout')

@section('content')
    <h2>Database</h2>
    <p>Ingiza taarifa za database. Tutatest connection kabla ya kuendelea.</p>

    <form method="POST" action="{{ route('install.database.test') }}">
        @csrf

        <div class="grid" style="margin-top:14px">
            <div class="panel">
                <div class="row">
                    <label>Driver</label>
                    <select name="connection">
                        @foreach (['mysql' => 'MySQL', 'pgsql' => 'PostgreSQL', 'sqlsrv' => 'SQL Server', 'sqlite' => 'SQLite'] as $k => $v)
                            <option value="{{ $k }}" @selected(($data['connection'] ?? '') === $k)>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <label>Database Name / Path</label>
                    <input name="database" value="{{ $data['database'] ?? '' }}" placeholder="e.g. malkia_db or /full/path/database.sqlite">
                    <div class="small">Kwa SQLite, weka full path ya file (au uache default ya Laravel kwenye .env).</div>
                </div>
            </div>

            <div class="panel">
                <div class="row">
                    <label>Host</label>
                    <input name="host" value="{{ $data['host'] ?? '' }}" placeholder="127.0.0.1">
                </div>

                <div class="row">
                    <label>Port</label>
                    <input name="port" value="{{ $data['port'] ?? '' }}" placeholder="3306">
                </div>

                <div class="row">
                    <label>Username</label>
                    <input name="username" value="{{ $data['username'] ?? '' }}" placeholder="root">
                </div>

                <div class="row">
                    <label>Password</label>
                    <input type="password" name="password" value="{{ $data['password'] ?? '' }}" placeholder="">
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="btn primary" type="submit">Test & Continue</button>
            <a class="btn ghost" href="{{ route('install.requirements') }}">Back</a>
        </div>
    </form>
@endsection
