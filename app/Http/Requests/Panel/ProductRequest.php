<?php

namespace App\Http\Requests\Panel;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if (empty($this['description'])) {
            $this['description'] = '';
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $attributes = $this->route('product') ? [] : ['attributes' => ['required', 'array']];

        return [
            'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
            'title'       => ['required', 'string', 'min:3', 'max:250'],
            'reviews_mod' => ['integer', Rule::in(Product::REVIEWS_MOD)],
            'slug'        => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('products')->ignore($this->route('product')),
            ],
            'img'         => ['string', 'max:250'],
            'description' => ['string', 'max:500'],
            'body'        => ['required', 'string'],
            ... $attributes,
        ];
    }
}
