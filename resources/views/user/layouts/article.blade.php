@extends('user.layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.show.top') }}" class="text-decoration-none text-body">←戻る</a>
    <div class="ms-3">
        <p class="mt-3 mb-0">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }}</p>
        <h1>{{ $article->title }}</h1>
        <div class="mt-3">
            <h2>
                {!! nl2br(e($article->article_contents)) !!} 
            </h2>
           
        </div>
    </div>
  
</div>
@endsection