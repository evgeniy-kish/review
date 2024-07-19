<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    public function index()
    {
        $rubrics = Rubric::withCount('articles')
            ->get();

        $articles = Article::latest('id')
            ->paginate(3);

        $news = Article::latest('id')
            ->take(3)
            ->get();

        return view('blog.index', compact('rubrics', 'articles', 'news'));
    }

    public function rubric(Rubric $rubric)
    {
        $articles = $rubric->articles()
            ->latest('id')
            ->paginate(3);

        return view('blog.rubric', compact('rubric', 'articles'));
    }

    public function show(string $rubric_slug, Article $article)
    {
        if ($article->rubric->slug !== $rubric_slug) {
            abort(404);
        }

        $article->load(['comments' => static fn($q) => $q->with('user')->latest('id')]);
        $article->loadCount('likes');

        return view('blog.show', compact('article'));
    }

    public function like(Article $article, Request $request)
    {
        return $request['act'] ? $article->like() : $article->unlike();
    }

    public function search(Request $request)
    {
        $articles = Article::where('title', 'like', "%{$request['token']}%")
            ->latest('id')
            ->take(3)
            ->get();

        if ($articles->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('blog.rows', compact('articles'))->render();
    }
}
