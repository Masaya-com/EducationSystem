<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

         // バリデーション
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        ], [
        'email.required' => 'メールアドレスを入力してください',
        'email.email'    => '有効なメールアドレスを入力してください',
        'password.required' => 'パスワードを入力してください',
        'password.min'   => 'パスワードは8文字以上で入力してください',
        ]);
        

        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {
            return redirect()->intended('/admin/top');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->input('name'),
            'kana' => $request->input('kana'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.show.login')->with('success', '登録が完了しました');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}