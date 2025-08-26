<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認可はコントローラやポリシーで制御する場合は調整
    }

    public function rules()
    {
        return [
            'banners'   => 'nullable',
            'banners.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'banners.*.image' => 'アップロードできるのは画像ファイルのみです。',
            'banners.*.mimes' => 'jpeg, png, jpg, gif, svg のみアップロード可能です。',
            'banners.*.max'   => '画像サイズは2MB以下にしてください。',
            'image.image'     => 'アップロードできるのは画像ファイルのみです。',
            'image.mimes'     => 'jpeg, png, jpg, gif, svg のみアップロード可能です。',
            'image.max'       => '画像サイズは2MB以下にしてください。',
        ];
    }
}