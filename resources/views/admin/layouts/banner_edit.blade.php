@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>バナー管理画面</h1>

    {{-- フラッシュメッセージ --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <div>アップロードに失敗しました：</div>
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 画像アップロード（複数可） --}}
    <form method="POST" action="{{ route('admin.banner.update') }}" enctype="multipart/form-data" class="mb-4">
        @csrf
        @method('PUT')

        <div id="banner-list">
            <div class="banner-item d-flex align-items-center mb-3">
                <img src="https://via.placeholder.com/100x50"
                     alt="プレビュー" class="banner-image me-3"
                     style="width:100px; height:50px; object-fit:cover;">
                <input type="file" name="banners[]" class="form-control me-3" style="width: 250px;">
                <button type="button" class="btn btn-danger btn-sm remove-banner rounded-circle"
                        style="width:30px; height:30px; padding:0;">−</button>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="button" id="add-banner" class="btn btn-primary rounded-circle"
                    style="width:30px; height:30px; padding:0;">＋</button>
            <button type="submit" class="btn btn-success">写真を登録する</button>
        </div>
    </form>

    {{-- 既存バナー一覧 --}}
    <h2 class="h4">登録済みバナー</h2>
    <div class="row">
        @forelse($banners as $banner)
            <div class="col-md-3 mb-3 d-flex flex-column align-items-center">
                <img src="{{ asset('storage/'.$banner->image) }}"
                     alt="banner" class="img-thumbnail mb-2" style="width:100%; max-width:260px; height:auto;">
                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">削除</button>
                </form>
            </div>
        @empty
            <p>まだバナーが登録されていません。</p>
        @endforelse
    </div>
</div>

{{-- 追加・削除（クライアント側の行操作） --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bannerList = document.getElementById('banner-list');
    const addBannerBtn = document.getElementById('add-banner');

    bannerList.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-banner')) {
            const item = e.target.closest('.banner-item');
            // 最低1行は残す
            if (bannerList.querySelectorAll('.banner-item').length > 1) {
                item.remove();
            } else {
                alert('最低1つは残す必要があります');
            }
        }
    });

    addBannerBtn.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'banner-item d-flex align-items-center mb-3';
        newItem.innerHTML = `
            <img src="https://via.placeholder.com/100x50"
                 alt="プレビュー" class="banner-image me-3"
                 style="width:100px; height:50px; object-fit:cover;">
            <input type="file" name="banners[]" class="form-control me-3" style="width: 250px;">
            <button type="button" class="btn btn-danger btn-sm remove-banner rounded-circle"
                    style="width:30px; height:30px; padding:0;">−</button>
        `;
        bannerList.appendChild(newItem);
    });
});
</script>

<style>
.banner-image {
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
@endsection