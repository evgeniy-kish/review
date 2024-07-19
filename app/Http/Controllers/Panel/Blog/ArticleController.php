<?php

namespace App\Http\Controllers\Panel\Blog;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Panel\Blog\ArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest('id')
            ->paginate(6);

        return view('panel.blog.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('panel.blog.articles.create', ['article' => new Article()]);
    }


    public function store(ArticleRequest $request)
    {
        $request
            ->user()
            ->articles()
            ->create($request->validated());

        session()->flash('flash', ['message' => 'Статья добавлена']);

        return response()
            ->json(['redirect' => route('panel.blog.articles.index')]);
    }


    public function edit(Article $article)
    {
        return view('panel.blog.articles.edit', compact('article'));
    }


    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->safe()->toArray());

        session()->flash('flash', ['message' => 'Статья обновлена']);

        return response()
            ->json(['redirect' => route('panel.blog.articles.index')]);
    }


    public function destroy(Article $article)
    {
        $article->delete();

        session()->flash('flash', ['message' => 'Статья удалена']);

        return response()
            ->json(['redirect' => route('panel.blog.articles.index')]);
    }

    public function search(Request $request)
    {
        $articles = Article::where('title', 'like', "%{$request['token']}%")
            ->orWhereHas('rubric', static fn($q) => $q->where('title', 'like', "%{$request['token']}%"))
            ->take(30)
            ->get();

        if ($articles->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.blog.articles.table', compact('articles'))->render();
    }
}
