<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin; // ← 管理者モデルを使う
use App\Http\Controllers\Admin\Auth\RegisterController;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 管理者登録完了後のリダイレクト先
    protected $redirectTo = '/admin/login';

    public function __construct()
    {
        $this->middleware('guest:admin'); // 未ログイン管理者のみアクセス可
    }

    // 登録フォーム表示
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    // 登録処理
    public function register(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255', // blade の name_kana に対応
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => '名前を入力してください',
            'kana.required' => 'フリガナを入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上必要です',
            'password.confirmed' => '確認用パスワードと一致しません',
        ]);

        // DB登録
        Admin::create([
            'name' => $request->input('name'),
            'kana' => $request->input('kana'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // 登録成功後にログインページへリダイレクト
        return redirect()->route('admin.login')->with('success', '管理者を登録しました。');
    }

    // 認証ガードを admin に指定
    protected function guard()
    {
        return Auth::guard('admin');
    }
}

