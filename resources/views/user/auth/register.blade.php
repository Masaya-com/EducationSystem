@extends('user.layouts.app')

@section('content')
<div class="container mt-5">
    {{-- 右上のログインリンク --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user.login') }}">ログインはこちら</a>
    </div>

    {{-- 中央のタイトル --}}
    <div class="text-center mb-4">
        <h1 class="h1">新規管理ユーザー登録</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <form method="POST" action="{{ route('user.register') }}">
                    @csrf

                    {{-- ユーザーネーム --}}
                    <div class="row mb-3 align-items-center">
                        <label for="name" class="col-md-3 col-form-label text-md-end">ユーザーネーム</label>
                        <div class="col-md-7">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- カナ --}}
                    <div class="row mb-3 align-items-center">
                        <label for="name_kana" class="col-md-3 col-form-label text-md-end">カナ</label>
                        <div class="col-md-7">
                            <input id="name_kana" type="text"
                                   class="form-control @error('name_kana') is-invalid @enderror"
                                   name="name_kana" value="{{ old('name_kana') }}">
                            @error('name_kana')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- メールアドレス --}}
                    <div class="row mb-3 align-items-center">
                        <label for="email" class="col-md-3 col-form-label text-md-end">メールアドレス</label>
                        <div class="col-md-7">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- パスワード --}}
                    <div class="row mb-3 align-items-center">
                        <label for="password" class="col-md-3 col-form-label text-md-end">パスワード</label>
                        <div class="col-md-7">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- パスワード確認 --}}
                    <div class="row mb-4 align-items-center">
                        <label for="password-confirm" class="col-md-3 col-form-label text-md-end">パスワード確認</label>
                        <div class="col-md-7">
                            <input id="password-confirm" type="password"
                                   class="form-control"
                                   name="password_confirmation">
                        </div>
                    </div>

                    {{-- 登録ボタン --}}
                    <div class="row">
                        <div class="col-md-8 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                登録
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
