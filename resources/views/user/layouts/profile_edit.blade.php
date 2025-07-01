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

    <a href="{{ route('user.show.top') }}" class="text-decoration-none text-body">←戻る</a>
    <h1 class="mt-3">プロフィール変更</h1>
    <div class="ms-5">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"  class="mt-3">
        @csrf
        @method('PUT')
            <div class="form-group mt-2 d-flex align-items-center">
                @if($user->profile_image)
                    <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像" width="100" class="me-3 mt-2">
                @endif
                <div class="flex-grow-1">
                    <label for="profile_image"><h2>プロフィール画像</h2></label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control w-75">
                </div>
            </div>
            <div class="form-group mt-5 d-flex align-items-center">
                <label for="name" class="me-2" style="min-width:120px;">ユーザーネーム</label>
                <input type="text" name="name" id="name" class="form-control w-50">
            </div>
            <div class="form-group mt-4 d-flex align-items-center">
                <label for="name-kana" class="me-2" style="min-width:120px;">カナ</label>
                <input type="text" name="name_kana" id="name-kana" class="form-control w-50">
            </div>
            <div class="form-group mt-4 d-flex align-items-center">
                <label for="email" class="me-2" style="min-width:120px;">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control w-50">
            </div>
            <div class="form-group d-flex mt-4 align-items-center">
                <label for="password" class="me-2" style="min-width:120px;">パスワード</label>
                <a href="{{ route('user.show.password.edit') }}" class="text-decoration-none text-body form-control w-50">パスワードを変更する</a>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger mt-5">登録</button>
            </div>
        </form>  
    </div>
  
</div>
@endsection