<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    //ログイン
    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email'    => 'required|email|min:8|max:255',
        'password' => 'required|string|min:8|max:255',
    ], [
        // email のエラー
        'email.required' => 'メールアドレスが入力されていません',
        'email.email'    => '正しいメールアドレス形式で入力してください',
        'email.min'      => '8文字以上入力してください',
        'email.max'      => '255字以内で入力してください',

        // password のエラー
        'password.required' => 'パスワードが入力されていません',
        'password.min'      => '8文字以上入力してください',
        'password.max'      => '255字以内で入力してください',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->route('user.show.top');
    }

    // 認証失敗時のエラーメッセージ
    return back()->withErrors([
        'email' => '登録されたメールアドレスと一致していません',
        'password' => '登録されたパスワードと一致していません',
    ])->withInput($request->only('email'));
    }

    //ログアウト
    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/user/login');
    }
}
