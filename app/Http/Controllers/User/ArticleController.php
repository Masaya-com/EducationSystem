<?php

namespace App\Http\Controllers\User;

use App\Models\Article;

class ArticleController extends Controller
{
   

    
    public function showArticle()
    {
        $article = Article::all();

        return view('user.article', compact('article'));
    }

}
