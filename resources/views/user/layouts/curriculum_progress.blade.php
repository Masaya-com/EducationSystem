@extends('user.layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.show.top') }}" class="text-decoration-none text-body">←戻る</a>
    <div class="profile">
        @if($user->profile_image)
            <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像" width="100" class="mt-1">
        @endif
        <h1 class="mt-3">{{ $user->name }}の授業進捗</h1>
        <p class="mt-1">現在の学年: 
            <span class="bg-info rounded-pill px-4 py-2">
                {{ optional($user->grade)->name ?? '未設定' }}
            </span>
        </h1>
    </div>
    <table class="table align-middle">
        <tbody>
        @php
            $gradesList = [
                '小学校1年生','小学校2年生','小学校3年生','小学校4年生','小学校5年生','小学校6年生',
                '中学校1年生','中学校2年生','中学校3年生',
                '高校1年生','高校2年生','高校3年生'
            ];
            $columns = 3;
        @endphp
        @for ($row = 0; $row < 4; $row++)
            <tr>
                @for ($col = 0; $col < $columns; $col++)
                    @php $index = $row * $columns + $col; @endphp
                    <td>
                        @if (isset($gradesList[$index]))
                            <div class="fw-bold bg-info rounded-pill px-4">{{ $gradesList[$index] }}</div>
                            @foreach ($curriculums->where('grade_id', $index + 1) as $curriculum)
                                <div class="mt-2">
                                    <a href="{{ route('curriculums.show', $curriculum->id) }}" class="text-decoration-none">
                                      @if (optional($user->curriculumProgress->where('curriculum_id', $curriculum->id)->first())->is_completed)
                                       <span class="badge bg-danger ms-2">受講済</span>
                                      @endif
                                        {{ $curriculum->title }}
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </td>
                @endfor
            </tr>
        @endfor
        </tbody>
    </table>
</div>
@endsection