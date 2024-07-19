<?php

namespace App\Http\Controllers\Panel\Faq;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Faq\SubjectRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('questions')
            ->get();

        return view('panel.faq.subjects.index', compact('subjects'));
    }

    public function store(SubjectRequest $request)
    {
        Subject::create($request->all());

        session()->flash('flash', ['message' => 'Тема добавлена']);

        return response()
            ->json(['redirect' => route('panel.faq.subjects.index')]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->all());

        session()->flash('flash', ['message' => 'Тема обновлена']);

        return response()
            ->json(['redirect' => route('panel.faq.subjects.index')]);
    }


    public function destroy(Subject $subject)
    {
        if ($subject->questions()->count()) {
            return response()->json(['error' => 'Нельзя удалить непустую тему'], 422);
        }

        $subject->delete();

        session()->flash('flash', ['message' => 'Тема удалена']);

        return response()
            ->json(['redirect' => route('panel.faq.subjects.index')]);
    }
}
