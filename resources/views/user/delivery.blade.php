@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user_delivery.css') }}">

<div class="delivery-container">
    <a href="{{ route('user.show.top') }}" class="back-link">← 戻る</a>

    <div class="video-content">
        <div class="video-wrapper">
            @if ($canWatch)
                <video controls>
                    <source src="{{ asset('storage/' . $curriculum->video_url) }}" type="video/mp4">
                    お使いのブラウザでは再生できません。
                </video>
            @else
                <p class="unavailable">現在、この動画は公開されていません。</p>
            @endif
        </div>

        @if ($canWatch)
            <form action="{{ route('user.delivery.clear', $curriculum->id) }}" method="POST">
                @csrf
                <button class="watched-btn">受講しました</button>
            </form>
        @endif
    </div>

    <div class="curriculum-info">
        <span class="grade-badge">{{ $curriculum->grade->name ?? '未設定' }}</span>
        <h2 class="curriculum-title">{{ $curriculum->title }}</h2>
        <div class="curriculum-description">
            <p>講座内容</p>
            <p>{{ $curriculum->description }}</p>
        </div>
    </div>
</div>
@endsection
