@extends('layouts.app')

@section('title', 'Login User')

@section('content')
    <h2>Login User</h2>

    @if(session('success'))
        <div class="success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="captcha">Captcha:</label>
            <div style="margin-bottom:5px;font-weight:bold;font-size:18px;">
                {{ session('captcha') }}
            </div>
            <input type="text" id="captcha" name="captcha" maxlength="4" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </form>
@endsection