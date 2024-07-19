<?php

namespace App\Http\Controllers\Panel;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])
            ->latest('id')
            ->paginate(10);

        return view('panel.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash('flash', ['message' => 'Комментарий удалён']);

        return response()->json(['redirect' => route('panel.comments.index')]);
    }

    public function search(Request $request)
    {
        $comments = Comment::where('message', 'like', "%{$request['token']}%")
            ->orWhereHas('user', static fn($q) => $q->where('name', 'like', "%{$request['token']}%"))
            ->with(['user', 'post'])
            ->latest('id')
            ->take(30)
            ->get();

        if ($comments->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.comments.table', compact('comments'))->render();
    }
}
