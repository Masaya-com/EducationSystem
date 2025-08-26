<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

class UserTopController extends Controller
{
     public function showTop()
    {
        return view('user.auth.top'); // resources/views/admin/layouts/top.blade.php を表示
    }
}
