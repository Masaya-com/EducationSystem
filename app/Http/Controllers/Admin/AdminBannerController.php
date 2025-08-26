<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\DB;
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

   public function update(BannerRequest $request)
{
    $files = $request->file('banners', []); // 配列で取得

    if (empty($files)) {
        return back()->with('error', '画像が選択されていません。');
    }

    DB::beginTransaction();
    try {
        foreach ($files as $file) {
            $path = $file->store('banners', 'public');

            $banner = new Banner();
            $banner->image = $path; // imageカラムに保存
            $banner->save();
        }

        DB::commit();
        return redirect()->route('admin.banner.edit')
            ->with('success', 'バナーを登録しました！');
    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Banner upload failed', ['error' => $e->getMessage()]);
        return back()->with('error', 'バナー登録に失敗しました。');
    }
}


    public function destroy(Banner $banner)
    {
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