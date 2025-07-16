@extends('layouts.app')

@section('content')
@vite('resources/css/home.css')

<div class = "list-container">
    <!-- 戻るリンク先がないため*で代用 -->
    <a href=*>←戻る</a>
    <h2>授業一覧</h2>
    <div>
        <button class = "create" type = "button" onclick = "location.href ='{{route('admin.show.curriculum.create')}}'">新規登録</button>
        <h4 id="topgrade-name">{{ $topgrade->name }}</h4>
    </div>
    <div id="content-area">
        <div id="othergrades-button">
            @foreach ($othergrades as $grade)
                <button class="grade-button" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</button>
            @endforeach
        </div>
        <div id="curriculum-list">
            @foreach($curriculums as $curriculum)
                <div>
                    <img src="{{ asset($curriculum->thumbnail) }}" alt="画像" width="100">
                    <p>{{ $curriculum->title }}</p>
                    @foreach($curriculum->deliveryTimes as $delivery)
                        <p>{{ \Carbon\Carbon::parse($delivery->delivery_from)->format('m月d日 H:i') }} ～
                            {{ \Carbon\Carbon::parse($delivery->delivery_to)->format('H:i') }}
                        </p>
                    @endforeach
                    <div class="edit-button">
                    <button class = "curriculumedit" onclick="location.href='{{ route('admin.show.curriculum.edit', ['id' => $curriculum->id]) }}'">授業内容編集</button>
                    <button class = "deliveryedit" onclick="location.href='{{ route('admin.show.delivery.edit', ['id' => $curriculum->id]) }}'">配信日時編集</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).on("click", ".grade-button", function () {
    const gradeId = $(this).data('grade-id');

    $.ajax({
        url: "{{ route('admin.show.curriculum.list') }}",
        method: "GET",
        dataType: "json",
        data: {
            grade_id: gradeId
        }
    }).done(function (res) {
        $('#topgrade-name').text(res.topgrade_name);
        let othergrade_button = '';
        res.othergrades.forEach(function (grade) {
            othergrade_button += `<button class="grade-button" data-grade-id="${grade.id}">${grade.name}</button>`;
        });
        $('#othergrades-button').html(othergrade_button);

        let curriculumlist = '';
        res.curriculums.forEach(function (curriculum) {
            curriculumlist += 
                `<div>
                    <img src="/${curriculum.thumbnail}" width="100" alt="画像">
                    <p>${curriculum.title}</p>`;

            curriculum.delivery_times.forEach(function (delivery) {
                const from = formatdatetime(delivery.delivery_from);
                const to = formattime(delivery.delivery_to);
                curriculumlist += `<p>${from} ～ ${to}</p>`;
            });

            curriculumlist += 
                `<div class="edit-button">
                <button class = "curriculumedit" onclick="location.href='/admin/curriculum_edit/${curriculum.id}'">授業内容編集</button>
                <button class = "deliveryedit" onclick="location.href='/admin/delivery_edit/${curriculum.id}'">配信日時編集</button>
                </div>
                </div>`;
        });
        $('#curriculum-list').html(curriculumlist);
    });

    function formatdatetime(fromdata) {
        const from = new Date(fromdata);
        return (from.getMonth() + 1) + '月' + from.getDate() + '日 ' + String(from.getHours()).padStart(2, '0') + ':' + String(from.getMinutes()).padStart(2, '0');
    }

    function formattime(todata) {
        const to = new Date(todata);
        return String(to.getHours()).padStart(2, '0') + ':' + String(to.getMinutes()).padStart(2, '0');
    }
});
</script>
@endsection
