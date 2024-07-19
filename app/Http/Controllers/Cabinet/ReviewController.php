<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = $request
            ->user()
            ->reviews()
            ->with('product')
            ->latest('id')
            ->paginate(10);

        return view('cabinet.reviews.index', compact('reviews'));
    }

    public function search(Request $request)
    {
        $reviews = $request
            ->user()
            ->reviews()
            ->whereHas('product', static fn($q) => $q->where('title', 'like', "%{$request['token']}%"))
            ->with(['user:id,name', 'product:id,title'])
            ->latest('id')
            ->take(30)
            ->get();

        if ($reviews->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('cabinet.reviews.table', compact('reviews'))->render();
    }
}