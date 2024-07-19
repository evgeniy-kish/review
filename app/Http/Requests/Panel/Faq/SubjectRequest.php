<?php

namespace App\Http\Requests\Panel\Faq;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'title' => 'required|min:3|max:100',
            'slug'  => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('subjects')->ignore($this->route('subject')?->id)
            ]
        ];
    }
}
