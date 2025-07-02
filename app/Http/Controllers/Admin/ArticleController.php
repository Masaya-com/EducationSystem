<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function showArticleList()
    {
        $articles = Article::all();

        return view('admin.layouts.article_list', compact('articles'));
    }


    public function showArticleCreate()
    {
        $articles = Article::all();
        return view('admin.layouts.article_create', compact('articles'));
    }

    public function showArticleEdit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.layouts.article_edit', compact('article'));
    }
  
    
    public function articleStore(ArticleRequest $request)
    {
        try{
            $article = new Article($request->validated());

            $article->save();

            return redirect()->route('admin.show.article.list')->with('success', 'お知らせを登録しました。');
        }catch(\Exception $e){
          return redirect()->back()->with('error' , 'お知らせ登録中にエラーが発生しました。' . $e->getMessage());
        }
    }

  
    public function articleUpdate(ArticleRequest $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->fill($request->validated());  
            $article->save();
            
            return redirect()->route('admin.show.article.list')->with('success', 'お知らせを更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'お知らせ更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }

   
    public function articleDestroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return redirect()->route('admin.show.article.list')->with('success', 'お知らせを削除しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'お知らせ削除中にエラーが発生しました: ' . $e->getMessage());
        }
    }
}
