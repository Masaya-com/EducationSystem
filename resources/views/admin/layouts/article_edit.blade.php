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

    <a href="{{ route('admin.show.article.list') }}" class="text-decoration-none text-body">←戻る</a>
    <h1 class="mt-3">お知らせ変更</h1>
    <form action="{{ route('admin.article.update', $article->id)}}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <input type="date" name="posted_date" id="posted_date" class="form-control" value="{{ old('posted_date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
        </div>
        <div class="form-group mt-3">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}">
        </div>
        <div class="form-group mt-3">
            <label for="content">本文</label>
            <textarea name="article_contents" id="article_contents" class="form-control">{{ $article->article_contents }}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-secondary mt-3">変更</button>
        </div>
    </form>
</div>
@endsection