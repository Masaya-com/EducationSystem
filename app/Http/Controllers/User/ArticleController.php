<?php

namespace App\Http\Controllers\User;

use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);

        return view('user.layouts.article', compact('article'));
    }

}
