@extends('layouts.app')

@section('content')
@vite('resources/css/list.css')
<div class="form-container">
    <a id = "back" href="{{route('admin.show.curriculum.list')}}">←戻る</a>
    <h2 id = "top">授業設定</h2>
    <form method = 'POST' class="form" enctype = 'multipart/form-data' action = "{{route('admin.show.curriculum.update')}}">
        @csrf
        <div><input type = "hidden" name = "id" value ="{{$curriculum->id}}"></div>
        <div class="thumbnail">
            <label>サムネイル</label><br>
            <input type ="file" name = "thumbnail" value = "{{$curriculum->thumbnail}}">
                @if($errors->has('thumbnail'))
                    <p>{{ $errors->first('thumbnail') }}</p>
                @endif
        </div>
        <div class="form-div">
            <label>学年</label>
            <select name = "grade_id">
                @foreach($grades as $grade)
                <option value="{{ $grade->id }}" {{ $grade->id == $curriculum->grade_id ? 'selected' : '' }}>{{$grade->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-div">
            <label>授業名</label>
            <input type = "text" name = "title" value="{{$curriculum->title}}">
                @if($errors->has('title'))
                    <p>{{ $errors->first('title') }}</p>
                @endif
        </div>
        <div class="form-div">
            <label>動画URL</label>
            <input type = "text" name = "video_url" value="{{$curriculum->video_url}}">
                @if($errors->has('video_url'))
                    <p>{{ $errors->first('video_url') }}</p>
                @endif
        </div>
        <div class="form-div">
            <label>授業概要</label>
            <textarea name = "description" row="20" col="2">{{ old('description', $curriculum->description) }}</textarea>
                @if($errors->has('description'))
                    <p>{{ $errors->first('description') }}</p>
                @endif
        </div>
        <div class="flg">
            <label>常時公開</label>
            <input type="checkbox" name="alway_delivery_flg" value="1" 
                    {{ $curriculum->alway_delivery_flg ? 'checked' : '' }}>
        </div>
        <button class = "addbutton" type ="submit">登録</button>
    </form>
</div>
@endsection