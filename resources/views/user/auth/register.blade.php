@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user_register.css') }}">

<div class="register-container">
    <div class="register-header">
        <a class="login-link" href="{{ route('user.show.login') }}">ログインはこちら</a>
        <h2>新規会員登録</h2>
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

    <form method="POST" action="{{ route('user.register') }}" class="register-form">
    @csrf

    <div class="form-row">
        <label for="name">ユーザーネーム</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="form-row">
        <label for="name_kana">カナ</label>
        <input type="text" id="name_kana" name="name_kana" value="{{ old('name_kana') }}" required>
    </div>

    <div class="form-row">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-row">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-row">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-row" style="justify-content: center;">
        <button type="submit" class="register-btn">登録</button>
    </div>
</form>
</div>
@endsection
