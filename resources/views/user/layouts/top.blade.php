@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user_top.css') }}">

<div class="top-page">

    {{-- バナー --}}
    <div class="banner-carousel">
        <div class="slides">
            @foreach ($banners as $index => $banner)
                <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー画像" class="slide {{ $index === 0 ? 'active' : '' }}">
            @endforeach
        </div>
        <div class="dots">
            @foreach ($banners as $index => $banner)
                <span class="dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
            @endforeach
        </div>
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


@section('scripts')
{{-- 画像を変更する --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const index = dot.dataset.index;

                slides.forEach(slide => slide.classList.remove('active'));
                slides[index].classList.add('active');

                dots.forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
            });
        });
    });
</script>
@endsection
