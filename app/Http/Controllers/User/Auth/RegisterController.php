<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // ← 管理者モデルを使う
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/user/register';
 
    protected function redirectTo()
{
    // 登録完了後にログインページに戻すなど
    return route('user.login.form');
}


    // 管理者登録フォームを表示
    public function showRegistrationForm()
    {
        return view('user.auth.register'); // Bladeファイルは resources/views/admin/auth/register.blade.php
    }
    
    public function __construct()
    {
        $this->middleware('guest:user'); // 管理者の未ログイン者のみアクセス許可
    }

    // 管理者作成
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'name_kana' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
}

    protected function create(array $data)
    {
        return \App\Models\user::create([
            'name' => $data['name'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // 登録処理
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'name_kana' => $request->input('name_kana'), // blade の name_kana に対応
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('user.login.form')->with('success', '管理ユーザーを登録しました。');
        }
        // App\Http\Controllers\Auth\LoginController
        protected function authenticated(Request $request, $user)
        {
            if (Auth::guard('user')->check()) {
             return redirect()->route('user.auth.top'); // admin用
            } elseif (Auth::guard('user')->check()) {
                return redirect()->route('user.auth.top'); // user用に修正
            }

            return redirect('/');
                }
    }