<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminTopController extends Controller
{
     public function showTop()
    {
        return view('admin.top'); // resources/views/admin/layouts/top.blade.php を表示
    }
}
