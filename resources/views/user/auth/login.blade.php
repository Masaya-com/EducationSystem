@extends('user.layouts.app')

@section('content')
<div class="container mt-5">
    {{-- 右上に「新規会員登録はこちら」リンク --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user.register.form') }}">新規会員登録はこちら</a>
    </div>

    {{-- 中央のh1タイトル --}}
    <div class="text-center mb-4">
        <h1 class="h3">ログイン</h1>
        <form method="POST" action="{{ route('user.login') }}">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <!-- {{-- ここは元のタイトル（Login）を消してもいいかも --}}
                {{-- <div class="card-header">{{ __('Login') }}</div> --}} -->

                <div class="card-body">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        {{-- メールアドレス --}}
                        <div class="row mb-3 align-items-center">
                            <label for="email" class="col-md-3 col-form-label text-md-end">メールアドレス</label>
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- パスワード --}}
                        <div class="row mb-3 align-items-center">
                            <label for="password" class="col-md-3 col-form-label text-md-end">パスワード</label>
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Remember Me --}}
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- ログインボタン --}}
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-bs-warning">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    パスワードを忘れた方はこちら
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
