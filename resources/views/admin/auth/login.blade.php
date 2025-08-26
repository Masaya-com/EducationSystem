@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    {{-- 右上に「新規会員登録はこちら」リンク --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.register.form') }}">新規会員登録はこちら</a>
    </div>

    {{-- 中央のh1タイトル --}}
    <div class="text-center mb-4">
        <h1 class="h3">管理画面ログイン</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        {{-- メールアドレス --}}
                        <div class="row mb-3 align-items-center">
                            <label for="email" class="col-md-3 col-form-label text-md-end">メールアドレス</label>
                            <div class="col-md-7">
                                <input id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email"  autocomplete="email" autofocus value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- パスワード --}}
                        <div class="row mb-3 align-items-center">
                            <label for="password" class="col-md-3 col-form-label text-md-end" >パスワード</label>
                            <div class="col-md-7">
                                <input id="password" name="password" class="form-control"
                                    name="password"  autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                        {{-- ログインボタン --}}
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
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
