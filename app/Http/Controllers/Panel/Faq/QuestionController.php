<?php

namespace App\Http\Controllers\Panel\Faq;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Panel\Faq\QuestionRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest('id')
            ->paginate(6);

        return view('panel.faq.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('panel.faq.questions.create', ['question' => new Question()]);
    }


    public function store(QuestionRequest $request)
    {
        Question::create($request->safe()->toArray());

        session()->flash('flash', ['message' => 'Вопрос добавлен']);

        return response()
            ->json(['redirect' => route('panel.faq.questions.index')]);
    }


    public function edit(Question $question)
    {
        return view('panel.faq.questions.edit', compact('question'));
    }


    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->safe()->toArray());

        return to_route('panel.faq.questions.index')
            ->with('flash', ['message' => 'Вопрос обновлён']);
    }


    public function destroy(Question $question)
    {
        $question->delete();

        return to_route('panel.faq.questions.index')
            ->with('flash', ['message' => 'Вопрос удалён']);
    }

    public function search(Request $request)
    {
        $questions = Question::where('name', 'like', "%{$request['token']}%")
            ->orWhereHas('subject', static fn($q) => $q->where('title', 'like', "%{$request['token']}%"))
            ->take(30)
            ->get();

        if ($questions->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.faq.questions.table', compact('questions'))->render();
    }
}
