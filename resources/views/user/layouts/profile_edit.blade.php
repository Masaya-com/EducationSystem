@extends('user.layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('user.show.top') }}">←戻る</a>
    <h1 class="mt-3">プロフィール編集</h1>
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"  class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group mt-2">
            <label for="profile_image">プロフィール画像</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control">
            @if($user->profile_image)
                <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像" width="100" class="mt-2">
            @endif
        </div>
        <div class="form-group mt-2">
            <label for="name">ユーザーネーム</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for="name-kana">カナ</label>
            <input type="text" name="name_kana" id="name-kana" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for="password">パスワード</label>
            <a href="{{ route('show.password.edit') }}">パスワードを変更する</a>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger mt-3">登録</button>
        </div>
  </form>    
</div>
@endsection