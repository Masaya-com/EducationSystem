@extends('admin.layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('admin.show.top') }}" class="text-decoration-none text-body">←戻る</a>
    <h1 class="mt-3">お知らせ一覧</h1>
    <div class="mt-3">
        <a href="{{ route('admin.show.article.create') }}" class="btn btn-primary">新規登録</a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>投稿日時</th>
                <th>タイトル</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }}</td>
                    <td>{{ $article->title }}</td>
                    <td>
                        <a href="{{ route('admin.show.article.edit',$article->id)}}" class="btn btn-primary">変更する</a>
                        <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection