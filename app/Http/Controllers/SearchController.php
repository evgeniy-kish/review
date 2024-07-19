<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Filters\ProductFilter;

class SearchController extends Controller
{
    public function search(Request $request, ProductFilter $filter)
    {
        $products = Product::where('title', 'like', "%{$request['text']}%")
            ->filter($filter)
            ->with(['category' => fn($query) => $query->with('parent')])
            ->withCount('reviews')
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        return view('search', compact('products'));
    }
}
