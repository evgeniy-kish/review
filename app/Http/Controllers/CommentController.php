<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Article;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function review(Review $review, CommentRequest $request)
    {
        $review->comments()->create([
            'user_id'   => $request->user()->id,
            'parent_id' => $request['parent_id'],
            'message'   => $request['message'],
        ]);

        return back();
    }

    public function article(Article $article, CommentRequest $request)
    {
        $article->comments()->create([
            'user_id'   => $request->user()->id,
            'parent_id' => $request['parent_id'],
            'message'   => $request['message'],
        ]);

        return back();
    }
}
