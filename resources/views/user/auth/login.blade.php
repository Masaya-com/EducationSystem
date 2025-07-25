@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user_login.css') }}">

<div class="login-container">
    <div class="login-header">
        <h2>ログイン</h2>
        <a class="register-link" href="{{ route('user.show.register') }}">新規会員登録はこちら</a>
    </div>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.login') }}" class="login-form">
        @csrf

        <div class="form-row">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-row">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-row" style="justify-content: center;">
            <button type="submit" class="login-btn">ログイン</button>
        </div>
    </form>
</div>
@endsection
