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
    <a href="{{ route('user.show.profile') }}">←戻る</a>
    <h1 class="mt-1">パスワード変更</h1>
    <form action="{{ route('user.password.update') }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="current_password">旧パスワード</label>
            <input type="password" name="current_password" id="current_password" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="password">新パスワード</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="password_confirmation">新パスワード（確認）</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-secondary mt-3">変更</button>
        </div>
    </form>
</div>
@endsection
