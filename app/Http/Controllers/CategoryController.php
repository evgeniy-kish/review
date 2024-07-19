<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)
            ->with(['children' => static function ($builder) {
                $builder->withCount('products');
            }])
            ->get();

        return view('categories.index', compact('categories'));
    }
}
