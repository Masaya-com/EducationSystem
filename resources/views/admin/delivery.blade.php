@extends('layouts.app')

@section('content')
@vite('resources/css/delivery.css')
<div class = "list-container">
<a href="{{route('admin.show.curriculum.list')}}">←戻る</a>
<h2>配信日時設定</h2>
<div><h4>{{$curriculum -> title}}</h4></div>
<form method="POST" action="{{ route('admin.show.delivery.update') }}">
    @csrf
    <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">

    <div id="delivery-container">
        @foreach ($delivery_times as $i => $delivery)
            <div class="delivery-form">
                <input type="hidden" name="id[]" value="{{ $delivery->id ?? '' }}">
                <input type="date" name="delivery_from_date[]" value="{{ old('delivery_from_date.' . $i, $delivery->delivery_from_date) }}">
                <input type="time" name="delivery_from_time[]" value="{{ old('delivery_from_time.' . $i, $delivery->delivery_from_time) }}">～
                <input type="date" name="delivery_to_date[]" value="{{ old('delivery_to_date.' . $i, $delivery->delivery_to_date) }}">
                <input type="time" name="delivery_to_time[]" value="{{ old('delivery_to_time.' . $i, $delivery->delivery_to_time) }}">
                <button type="button" class="remove">－</button>
            </div>
            <div>
                @error('delivery_from_date.' . $i)
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @error('delivery_from_time.' . $i)
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @error('delivery_to_date.' . $i)
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @error('delivery_to_time.' . $i)
                    <p class="error-message">{{ $message }}</p>
                @enderror
                </div>
        @endforeach
    </div>
    <button type="button" class="add">＋</button>
    <div>
        <button class ="add-button" type="submit">登録</button>
    </div>
</form>
</div>



@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
    //追加
    $(document).on("click", ".add", function () {
        const newRow = `
            <div class="delivery-form">
                <input type="hidden" name="id[]" value="">
                <input type="date" name="delivery_from_date[]" value="">
                <input type="time" name="delivery_from_time[]" value="">～
                <input type="date" name="delivery_to_date[]" value="">
                <input type="time" name="delivery_to_time[]" value="">
                <button type="button" class="remove">－</button>
            </div>
        `;
        $("#delivery-container").append(newRow);
    });

    //削除
    $(document).on("click", ".remove", function () {
        if ($(".delivery-form").length > 1) {
            $(this).closest(".delivery-form").remove();
        } else {
            alert("最低1件は必要です。");
        }
    });
});
</script>
@endsection
