<?php

namespace App\Http\Controllers\Panel;

use App\Models\Review;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('panel.index', [
            'articles_count' => Article::count(),
            'comments_count' => Comment::count(),
            'reviews_count'  => Review::count()
        ]);
    }
}
