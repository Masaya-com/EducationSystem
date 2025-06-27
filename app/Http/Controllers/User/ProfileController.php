<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfileForm()
    {
        $users = User::all();
        return view('user.profile_edit', compact('users'));
    }

   
    public function showPasswordForm()
    {
        $users = User::all();
        return view('user.password_edit', compact('users'));    
    }


    public function profileUpdate(ProfileRequest $request , User $user)
    {
        try {
            
            $user = fill($request->validated());

            if ($request->hasFile('profile_image')) { 
            $filename = $request->profile_image->getClientOriginalName();
            $filePath = $request->profile_image->storeAs('users', $filename, 'public');
            $product->profile_image = '/storage/' . $filePath;
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
