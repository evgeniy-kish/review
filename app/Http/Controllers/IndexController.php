<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Article;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)
            ->withCount('children')
            ->take(8)
            ->orderBy('id')
            ->get();

        $articles = Article::latest('id')
            ->without('user')
            ->take(3)
            ->get();

        // Todo:: Выбрать уникальных пользователей
        $reviews = Review::where('activity', 1)
            ->with('user')
            ->take(6)
            ->latest('id')
            ->get();

        return view('index', compact('categories', 'articles', 'reviews'));
    }
}
