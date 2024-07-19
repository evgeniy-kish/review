<?php

namespace App\Http\Requests\Panel\Blog;


use App\Models\Article;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rubric_id'   => 'required|integer|min:1|exists:rubrics,id',
            'title'       => 'required|min:3|max:255',
            'slug'        => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('articles')->ignore($this->route('article')?->id),
            ],
            'img'         => 'required|max:255',
            'description' => 'required|max:500',
            'body'        => 'required',
            'status'      => [
                'required',
                Rule::in(array_keys(Article::$status))
            ]
        ];
    }
}
