<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'name_kana'  => 'required|string|max:255|regex:/^[ァ-ヶー ]+$/u',
        'email'      => 'required|email|min:8|max:255|unique:users,email',
        'password'   => 'required|string|min:8|max:32|confirmed',
        'password_confirmation' => 'required|string|min:8|max:32',
    ], [
        'name.required'  => 'ユーザーネームは登録必須です',
        'name.max'       => 'ユーザーネームが文字数オーバーです',

        'name_kana.required' => 'カナは入力必須です',
        'name_kana.regex'    => '全角カタカナで入力してください',
        'name_kana.max'      => 'カナが文字数オーバーです',

        'email.required' => 'メールアドレスは必須項目です',
        'email.email'    => 'メールアドレスが無効です',
        'email.min'      => 'メールアドレスは8文字以上で入力してください',
        'email.max'      => 'メールアドレスが文字数オーバーです',
        'email.unique'   => 'このメールアドレスは既に登録されています',

        'password.required'  => 'パスワードは入力必須です',
        'password.min'       => 'パスワードは8文字以上で入力してください',
        'password.max'       => 'パスワードが文字数オーバーです',
        'password.confirmed' => 'パスワードが一致しません',

        'password_confirmation.required' => 'パスワード確認は入力必須です',
        'password_confirmation.min'      => 'パスワード確認は8文字以上で入力してください',
        'password_confirmation.max'      => 'パスワード確認が文字数オーバーです',
    ]);

    $user = User::create([
        'name'          => $request->name,
        'name_kana'     => $request->name_kana,
        'email'         => $request->email,
        'password'      => Hash::make($request->password),
        'profile_image' => null,
        'grade_id'      => null,
    ]);

    Auth::login($user);

    return redirect()->route('user.show.top')->with('success', '登録完了しました');
}
}
