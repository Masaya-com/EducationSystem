<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminBannerController extends Controller
{
    public function showBannerEdit()
    {
        // 既存バナーを一覧表示用に取得
        $banners = Banner::orderBy('id')->get();
        return view('admin.layouts.banner_edit', compact('banners'));
    }

    public function update(Request $request)
    {
        // 複数でも単発でも受けられるようにする
        $request->validate([
            'banners'   => 'nullable',
            'banners.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 単発対応
        ]);

        // アップロード配列を組み立て（banners[]優先、なければimage）
        $files = [];
        if ($request->hasFile('banners')) {
            $files = $request->file('banners');
        } elseif ($request->hasFile('image')) {
            $files = [$request->file('image')];
        }

        if (empty($files)) {
            return back()->with('error', 'ファイルが選択されていません。');
        }

        foreach ($files as $file) {
            // publicディスクに保存 => 戻り値は "banners/xxxx.jpg"
            $path = $file->store('banners', 'public');

            // テーブルのカラム名が image なのでそこに保存
            $banner = new Banner();
            $banner->image = $path;   // 例: banners/xxxx.jpg
            $banner->save();
        }

        return back()->with('success', 'バナーを登録しました。');
    }

    public function destroy(Banner $banner)
    {
        // 画像ファイル削除（あってもなくてもOKで続行）
        try {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
        } catch (\Throwable $e) {
            Log::warning('Banner image delete failed', ['id' => $banner->id, 'e' => $e->getMessage()]);
        }

        $banner->delete();

        return back()->with('success', 'バナーを削除しました。');
    }
}