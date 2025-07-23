<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Banner;

class TopController extends Controller
{
    public function showTop()
    {
        $articles = Article::latest('posted_date')->take(5)->get();
        $banners = Banner::all();

        return view('user.layouts.top', compact('articles', 'banners'));
    }
}
