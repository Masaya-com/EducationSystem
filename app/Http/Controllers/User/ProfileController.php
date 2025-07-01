<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfileForm()
    {
        $user = auth()->user();
        return view('user.layouts.profile_edit', compact('user'));
    }

   
    public function showPasswordForm()
    {
        $user = auth()->user();
        return view('user.layouts.password_edit', compact('user'));    
    }


    public function profileUpdate(UserRequest $request)
    {
        try {
            $user = auth()->user();
            $user->fill($request->validated());

            if ($request->hasFile('profile_image')) {
                $filename = $request->profile_image->getClientOriginalName();
                $filePath = $request->profile_image->storeAs('users', $filename, 'public');
                $user->profile_image = '/storage/' . $filePath;
            }

            $user->save();

            return redirect()->route('user.show.top')->with('success', 'プロフィールを更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'プロフィール更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }

    public function passwordUpdate(PasswordRequest $request)
    {
        try {
            $user = auth()->user();
            if (!\Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => '旧パスワードが正しくありません。']);
            }
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('user.show.profile')->with('success', 'パスワードを更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'パスワード更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }

}
