@extends('admin.layouts.app')

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
    
    <a href="{{ route('show.article.list') }}">←戻る</a>
    <h1 class="mt-3">お知らせ新規登録</h1>
    <form action="{{ route('article.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <input type="date" name="posted_date" id="posted_date" class="form-control" value="{{ old('posted_date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
        </div>
        <div class="form-group mt-3">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="content">本文</label>
            <textarea name="content" id="content" class="form-control" rows="5"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-secondary mt-3">登録</button>
        </div>
    </form>
</div>
@endsection