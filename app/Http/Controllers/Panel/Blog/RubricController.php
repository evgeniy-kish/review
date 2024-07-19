<?php

namespace App\Http\Controllers\Panel\Blog;

use App\Models\Rubric;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Blog\RubricRequest;

class RubricController extends Controller
{
    public function index()
    {
        $rubrics = Rubric::withCount('articles')
            ->get();

        return view('panel.blog.rubrics.index', compact('rubrics'));
    }

    public function store(RubricRequest $request)
    {
        Rubric::create($request->all());

        session()->flash('flash', ['message' => 'Рубрика добавлена']);

        return response()
            ->json(['redirect' => route('panel.blog.rubrics.index')]);
    }

    public function update(RubricRequest $request, Rubric $rubric)
    {
        $rubric->update($request->all());

        session()->flash('flash', ['message' => 'Рубрика обновлена']);

        return response()
            ->json(['redirect' => route('panel.blog.rubrics.index')]);
    }


    public function destroy(Rubric $rubric)
    {
        if ($rubric->articles()->count()) {
            return response()->json(['error' => 'Нельзя удалить непустую рубрику'], 422);
        }

        $rubric->delete();

        session()->flash('flash', ['message' => 'Рубрика Удалена']);

        return response()
            ->json(['redirect' => route('panel.blog.rubrics.index')]);
    }
}
