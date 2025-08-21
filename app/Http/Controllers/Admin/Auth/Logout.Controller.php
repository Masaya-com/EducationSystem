<?php

namespace App\Http\Controllers\admin;                       //修正

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;                        //追記

class LoginController extends Controller
{
    // use AuthenticatesUsers;                              //削除
    use AuthenticatesUsers {                                //追記
        logout as performLogout;                            //追記
    }                                                       //追記

    protected $redirectTo = '/admin/home';                  //修正


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); //修正
    }


    protected function guard()                              //追記
    {                                                       //追記
        return Auth::guard('admin');                        //追記
    }                                                       //追記


    public function logout(Request $request)                //追記
    {                                                       //追記
        $this->performLogout($request);                     //追記
        return redirect('admin/login');                     //追記
    }                                                       //追記
}