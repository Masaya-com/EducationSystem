<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'grade_id' => 'required|exists:grades,id',
            'title' => 'required|string',
            'video_url' => 'required|string',
            'description' => 'required|string',
            'alway_delivery_flg' => 'nullable|boolean',
            'thumbnail' => 'required|file|image|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'grade_id' => '学年',
            'title' => '授業名',
            'video_url' => 'URL',
            'description' => '概要',
            'alway_delivery_flg' => '公開フラグ',
            'thumbnail' => 'サムネイル',
        ];
    }

    public function messages() {
        return [
            'grade_id.required' => ':attributeは必須項目です。',
            'title.required' => ':attributeは必須項目です。',
            'video_url.required' => ':attributeは必須項目です。',
            'description.required' => ':attributeは必須項目です。',
            'thumbnail.required' => ':attributeは必須項目です。',
            'thumbnail.file' => ':attributeはファイルである必要があります。',
            'thumbnail.image' => ':attributeは画像ファイルである必要があります。',
        ];
    }
}
