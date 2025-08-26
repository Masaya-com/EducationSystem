@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    {{-- ヘッダー --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>授業一覧</h1>

    <div style="margin: 20px 0;">
        {{-- 前の月 --}}
        <a href="{{ route('user.curriculum.byGrade.month', [
        'gradeId' => $currentGrade->id ?? 0, 
        'month' => $currentMonth->copy()->subMonth()->format('Y-m')
    ]) }}">◀︎</a>

    <span>{{ $currentMonth->format('Y年n月') }}スケジュール</span>

        {{-- 次の月 --}}
        <a href="{{ route('user.curriculum.byGrade.month', [
        'gradeId' => $currentGrade->id ?? 0, 
        'month' => $currentMonth->copy()->addMonth()->format('Y-m')
    ]) }}">▶︎</a>
    </div>

    <ul>
        @forelse($deliverySchedules as $schedule)
            <li>{{ $schedule->delivery_from }} → {{ $schedule->delivery_to }}</li>
        @empty
            <li>この月のスケジュールはありません</li>
        @endforelse
    </ul>
        

        {{-- 現在の学年表示 --}}
       <div class="mt-3">
        @if(isset($currentGrade))
            <strong>現在の学年：</strong>
            <span class="badge bg-success">{{ $currentGrade->name }}</span>
        @else
            <span class="text-muted">学年未選択</span>
        @endif
    </div>
</div>

    <div class="row">
        {{-- 左サイドメニュー（学年ボタン縦並び） --}}
        <div class="col-md-2">
            <div class="list-group d-flex flex-column">
        @foreach ($grades as $grade)
            <a href="{{ route('user.curriculum.byGrade', ['gradeId' => $grade->id]) }}"
               class="btn {{ (isset($currentGrade) && $currentGrade->id == $grade->id) ? 'btn-success' : 'btn-primary' }} mb-2">
                {{ $grade->name }}
            </a>
        @endforeach
    </div>
</div>

        <div class="row">
    @forelse ($curriculums as $curriculum)
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100">
                @if ($curriculum->thumbnail)
                    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}"
                        alt="サムネイル"
                        class="card-img-top"
                        style="width:100%; height:150px; object-fit:cover">
                @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:150px;">
                        <span class="text-muted">サムネイル画像がまだ設定されていません</span>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $curriculum->title }}</h5>
                    <p>{{ $curriculum->description }}</p>
                    <div>
                        @foreach ($curriculum->deliveryTimes as $time)
                            <p class="mb-0">
                                {{ \Carbon\Carbon::parse($time->delivery_from)->format('n月j日 H:i') }}
                                ~
                                {{ \Carbon\Carbon::parse($time->delivery_to)->format('H:i') }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p>カリキュラムが登録されていません。</p>
        </div>
    @endforelse
</div>

                
        @endsection