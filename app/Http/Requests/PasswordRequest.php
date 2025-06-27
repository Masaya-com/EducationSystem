<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '旧パスワードを入力してください。',
            'password.required' => '新しいパスワードを入力してください。',
            'password.min' => '新しいパスワードは8文字以上で入力してください。',
            'password.confirmed' => '新しいパスワードが一致しません。',
        ];
    }
}
