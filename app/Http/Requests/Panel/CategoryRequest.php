<?php

namespace App\Http\Requests\Panel;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        foreach (['description', 'seo_title', 'seo_description'] as $item) {
            if (empty($this[$item])) {
                $this[$item] = '';
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $exists = 0 === (int)$this->input('parent_id') ? [] : [Rule::exists('categories', 'id')];

        return [
            'parent_id'       => [
                'required',
                'integer',
                'min:0',
                ... $exists
            ],
            'title'           => 'required|string|min:3|max:255',
            'slug'            => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories')->ignore($this->route('category'))
            ],
            'icon'            => ['nullable', 'string', 'max:250'],
            'description'     => ['string', 'max:290'],
            'seo_title'       => ['string', 'max:250'],
            'seo_description' => ['string', 'max:290'],
            'sort'            => 'required|integer|min:1|max:250',
        ];
    }
}
