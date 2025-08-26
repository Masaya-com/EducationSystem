@extends('admin.layouts.app')

@section('content')
<style>

    .content-center {
        margin-top: 100px;
        text-align: center;
    }

    .content-center h2 {
        margin-bottom: 20px;
    }
</style>
{{-- 中央コンテンツ --}}
<div class="content-center">
    <h2>ユーザーネーム：{{ Auth::guard('admin')->user()->name }}</h2>
    <h2>メールアドレス：{{ Auth::guard('admin')->user()->email }}</h2>
</div>
@endsection
