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
        </p>
    </div>
    <div class="row">
        <table class="table align-middle">
            <tbody>
            @foreach ($progressRows as $row)
                <tr>
                    @foreach ($row as $cell)
                        @if ($cell)
                        <td class="align-top" style="width:33%">
                            <div class="fw-bold bg-info rounded-pill px-4 py-2 mb-2">{{ $cell['grade_name'] }}</div>
                            @foreach ($cell['curriculums'] as $curriculum)
                                <div class="mt-2">
                                    <a href="{{ route('curriculums.show', $curriculum['id']) }}" class="text-decoration-none">
                                        @if ($curriculum['is_completed'])
                                            <span class="badge bg-danger ms-2">受講済</span>
                                        @endif
                                        {{ $curriculum['title'] }}
                                    </a>
                                </div>
                            @endforeach
                        </td>
                        @else
                        <td></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection