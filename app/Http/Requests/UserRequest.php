<?php

// app/Http/Controllers/Admin/Auth/LoginController.php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',],
        [
        'email.required' => 'メールアドレスを入力されていません',
        'email.email' => '有効なアドレスを入力してください',
        'password.required' => 'パスワードが入力されていません',
        'password.min' => 'パスワードは8文字以上で入力してください',
    ]);

        // 認証試行
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->filled('remember') // remember チェック
        )) {
            return redirect()->route('admin.show.top');
        }

        return back()->withErrors(['
        login_error' => 'ログインに失敗しました'        
        ])->withInput();
    }
}

