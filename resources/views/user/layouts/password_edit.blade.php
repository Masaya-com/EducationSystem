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
    <a href="{{ route('user.show.profile') }}" class="text-decoration-none text-body">←戻る</a>
    <h1 class="mt-1 mb-5">パスワード変更</h1>
    <form action="{{ route('user.password.update') }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group mt-3 d-flex align-items-center ms-3">
            <label for="current_password" class="me-2" style="min-width:140px;">旧パスワード</label>
            <input type="password" name="current_password" id="current_password" class="form-control w-50">
        </div>
        <div class="form-group mt-3 d-flex align-items-center ms-3">
            <label for="password" class="me-2" style="min-width:140px;">新パスワード</label>
            <input type="password" name="password" id="password" class="form-control w-50">
        </div>
        <div class="form-group mt-3 d-flex align-items-center ms-3">
            <label for="password_confirmation" class="me-2" style="min-width:140px;">新パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-50">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger mt-5">登録</button>
        </div>
    </form>
</div>
@endsection
