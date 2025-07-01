<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|max:255',
      'name_kana' => 'required|regex:/^[ァ-ヶー]+$/u|max:255',
      'email' => 'required|email|max:255|unique:users,email,' . ($this->user ? $this->user->id : ($this->id ?? 'null')),
      'password' => 'nullable|string|min:8|confirmed',
      'profile_image' => 'nullable|image|mimes:,png,jpg|max:2048',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => '名前を入力してください。',
      'name.max' => '名前は255文字以内でなければなりません。',
      'name_kana.required' => '名前（カタカナ）を入力してください。',
      'name_kana.regex' => '名前（カタカナ）はカタカナのみで入力してください。',
      'name_kana.max' => '名前（カタカナ）は255文字以内でなければなりません。',
      'email.required' => 'メールアドレスを入力してください。',
      'email.email' => '有効なメールアドレスを入力してください。',
      'email.max' => 'メールアドレスは255文字以内でなければなりません。',
      'email.unique' => 'このメールアドレスはすでに使用されています。',
      'password.min' => 'パスワードは8文字以上でなければなりません。',
      'password.confirmed' => 'パスワードが一致しません。',
      'profile_image.image' => 'プロフィール画像は画像ファイルでなければなりません。',
      'profile_image.mimes' => 'プロフィール画像はPNGまたはJPG形式でなければなりません。',
      'profile_image.max' => 'プロフィール画像のサイズは2MB以下でなければなりません。',
    ];
  }
}