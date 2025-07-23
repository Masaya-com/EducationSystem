@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user_top.css') }}">

<div class="top-page">

    {{-- バナー --}}
    <div class="banner-carousel">
        @foreach ($banners as $banner)
            <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー画像">
        @endforeach
    </div>

    {{-- お知らせ --}}
    <div class="notice">
        <h2>お知らせ</h2>
        <ul>
            @foreach ($articles as $article)
                <li>
                    <span class="date">{{ $article->posted_date->format('Y年n月j日') }}</span>
                    <span class="title">{{ $article->title }}</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>
@endsection
