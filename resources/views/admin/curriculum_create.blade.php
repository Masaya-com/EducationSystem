@extends('layouts.app')
@section('content')
@vite('resources/css/list.css')

<div class="form-container">
<a id = "back" href="{{route('admin.show.curriculum.list')}}">←戻る</a>
    <h2 id = "top">授業設定</h2>
    <form method='POST' class="form" enctype='multipart/form-data' action="{{route('admin.show.curriculum.add')}}">
        @csrf
        <div class="thumbnail">
            <label>サムネイル</label><br>
            <input type='file' name='thumbnail'>
                @if($errors->has('thumbnail'))
                    <p>{{ $errors->first('thumbnail') }}</p>
                @endif
        </div>
        <div class="form-div">
            <label>学年</label>
            <select name="grade_id">
                @foreach($grades as $grade)
                <option value="{{$grade->id}}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{$grade->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-div">
            <label>授業名</label>
            <input type="text" name="title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <p>{{ $errors->first('title') }}</p>
                    @endif
        </div>
        <div class="form-div">
            <label>動画URL</label>
            <input type="text" name="video_url" value="{{ old('video_url') }}">
                @if($errors->has('video_url'))
                    <p>{{ $errors->first('video_url') }}</p>
                @endif
        </div>
        <div class="form-div">
            <label>授業概要</label>
            <textarea name="description" rows="2" cols="30" >{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p>{{ $errors->first('description') }}</p>
                @endif
        </div>
        <div class="flg">
            <label>
                <input type="checkbox" name="alway_delivery_flg" value="1" {{ old('alway_delivery_flg') ? 'checked' : '' }}> 常時公開
            </label>
        </div>
        <button class = "addbutton" type="submit">登録</button>
    </form>
</div>
@endsection
