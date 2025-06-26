<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'post_date' => 'required|date',
            'title' => 'required|max:255',
            'article_content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'post_date.required' => '投稿日を入力してください。',
            'post_date.date' => '投稿日は有効な日付でなければなりません。',
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは255文字以内でなければなりません。',
            'article_content.required' => '記事内容を入力してください。',
        ];
    }
}
