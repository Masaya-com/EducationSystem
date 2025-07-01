@extends('user.layouts.app')

@section('content')
<div class="container">
    <a href="{{route('show.top'}}" class="text-decoration-none text-body">←戻る</a>
    <p class="mt-3">{{ $article->posted_date }}</p>
    <h1 class="mt-3">{{ $article->title }}</h1>
    <div class="mt-3">
        {!! nl2br(e($article->article_contents)) !!} 
    </div>
</div>
@endsection