<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)
            ->sorted()
            ->with(['children' => static fn($query) => $query->oldest('sort')])
            ->withCount('children')
            ->get();

        $select = $categories;

        return view('panel.categories.index', compact('categories', 'select'));
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        session()->flash('flash', ['message' => 'Категория добавлена']);

        $redirect = 0 === ($parent = (int)$request->input('parent_id'))
            ? route('panel.categories.index')
            : route('panel.categories.edit', Category::where('id', $parent)->first());

        return response()
            ->json(['redirect' => $redirect]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = $category->children()
            ->oldest('sort')
            ->get();

        $select = Category::where('parent_id', 0)
            ->sorted()
            ->withCount('children')
            ->get();

        return view('panel.categories.index', compact('category', 'categories', 'select'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        session()->flash('flash', ['message' => 'Категория обновлена']);

        $redirect = 0 === ($parent = (int)$request->input('parent_id'))
            ? route('panel.categories.index')
            : route('panel.categories.edit', Category::where('id', $parent)->first());

        return response()
            ->json(['redirect' => $redirect]);
    }

    public function destroy($id)
    {
        //
    }
}
