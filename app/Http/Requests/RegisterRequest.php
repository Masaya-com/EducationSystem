<?php

// app/Http/Controllers/Admin/Auth/RegisterController.php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'email.required' => 'メールアドレスを入力されていません',
            'email.email' => '有効なアドレスを入力してください',
            'password.required' => 'パスワードが入力されていません',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ]);

        Admin::create([
            'name' => $request->name,
            'kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.show.login')->with('success', '登録が完了しました');
    }
}
