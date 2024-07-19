<?php

namespace App\Http\Requests\Panel\Faq;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'subject_id' => 'required|integer|min:1|exists:subjects,id',
            'title'      => 'required|min:3|max:255',
            'answer'     => 'required|min:3|max:255',
            'slug'       => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('questions')->ignore($this->route('question')?->id),
            ],
        ];
    }
}
