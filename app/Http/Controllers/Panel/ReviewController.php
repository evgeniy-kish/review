<?php

namespace App\Http\Controllers\Panel;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller
{
    public function index()
    {
        $mod_reviews = Review::where('activity', 0)
            ->with(['user:id,name', 'product' => static function($q) {
                $q->select(['id', 'title'])->withTrashed();
            }])
            ->oldest('id')
            ->get();

        $reviews = Review::where('activity', 1)
            ->with(['user:id,name', 'product' => static function($q) {
                $q->select(['id', 'title'])->withTrashed();
            }])
            ->latest('id')
            ->paginate(10);

        return view('panel.reviews.index', compact('mod_reviews', 'reviews'));
    }

    public function edit(Review $review)
    {
        $review->load([
            'user',

            'product' => fn($q) => $q->withTrashed()->withCount(['reviews' => fn($q) => $q->where('activity', 1)
                ->where('created_at', '<=', Carbon::now())]),
        ]);

        return view('panel.reviews.edit', compact('review'));
    }

    public function create(Request $request)
    {
        return view('panel.reviews.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'activity' => ['required', 'integer', Rule::in(Review::STATUS)]
        ]);

        $review = Review::create($request->all());

        session()->flash('flash', ['message' => 'Отзыва создан']);

        return response()->json(['redirect' => route('panel.reviews.edit', $review)]);

    }

    public function update(Request $request, Review $review)
    {
        $this->validate($request, [
            'activity' => ['required', 'integer', Rule::in(Review::STATUS)]
        ]);

        $review->update($request->all());

        session()->flash('flash', ['message' => 'Отзыва обновлён']);

        return to_route('panel.reviews.edit', $review);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        session()->flash('flash', ['message' => 'Отзыв удалён']);

        return response()->json(['redirect' => route('panel.reviews.index')]);
    }

    public function destroyAll(Request $request)
    {
        foreach ($request['ids'] ?? [] as $id) {
            Review::find($id)?->delete();
        }

        session()->flash('flash', ['message' => 'Отзыв(ы) удалены']);

        return response()->json(['redirect' => route('panel.reviews.index')]);
    }


    public function event(Request $request, $event)
    {


        $text = '';
        if ($request->ids){
            switch ($event){
                case 'delete': $text = 'Отзыв(ы) удалены'; Review::destroy($request->ids); break;
                case 'active': $text = 'Отзыв(ы) активированы'; Review::query()->whereIn('id', $request->ids)->update(['activity' => 1]) ; break;
                case 'deactive': $text = 'Отзыв(ы) Деактивированы'; Review::query()->whereIn('id', $request->ids)->update(['activity' => 0]) ; break;
            }
        }


        session()->flash('flash', ['message' => $text]);

        return response()->json(['redirect' => route('panel.reviews.index')]);
    }

    public function search(Request $request)
    {
        $reviews = Review::whereHas(
            'product',
            static fn($q) => $q->where('title', 'like', "%{$request['token']}%")
        )->orWhereHas('user', static fn($q) => $q->where('name', 'like', "%{$request['token']}%"))
            ->with(['user:id,name', 'product:id,title'])
            ->latest('id')
            ->take(30)
            ->get();

        if ($reviews->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.reviews.table', compact('reviews'))->render();
    }

    protected function generateRating(Review $review)
    {
        return $review->product->update([
            'rating' => $review
                ->product
                ->loadAvg(['reviews' => fn($q) => $q->where('activity', 1)], 'rating')
                ->reviews_avg_rating ?: 0
        ]);
    }
}
