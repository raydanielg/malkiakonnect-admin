@extends('install.layout')

@section('content')
    <h2>Admin Account</h2>
    <p>Unda admin account ya kuingia kwenye mfumo.</p>

    <form method="POST" action="{{ route('install.admin.save') }}">
        @csrf

        <div class="grid" style="margin-top:14px">
            <div class="panel">
                <div class="row">
                    <label>Full Name</label>
                    <input name="name" value="{{ $data['name'] ?? '' }}" placeholder="Administrator">
                </div>

                <div class="row">
                    <label>Email</label>
                    <input name="email" value="{{ $data['email'] ?? '' }}" placeholder="admin@example.com">
                </div>
            </div>

            <div class="panel">
                <div class="row">
                    <label>Password</label>
                    <input type="password" name="password" value="" placeholder="Minimum 8 characters">
                </div>

                <div class="row">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" value="" placeholder="Repeat password">
                </div>

                <div class="small" style="margin-top:10px">Installer atai-mark user huyu kama <strong>is_admin</strong>.</div>
            </div>
        </div>

        <div class="actions">
            <button class="btn primary" type="submit">Continue</button>
            <a class="btn ghost" href="{{ route('install.settings') }}">Back</a>
        </div>
    </form>
@endsection
