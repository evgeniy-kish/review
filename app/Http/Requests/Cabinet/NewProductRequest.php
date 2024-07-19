<?php

namespace App\Http\Requests\Cabinet;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class NewProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
            'title'       => ['required', 'string', 'min:3', 'max:250'],
            'img'         => ['string', 'max:250'],
            'body'        => ['required', 'string'],
            'attributes'  => ['required', 'array']
        ];
    }

    /**
     * Добавить custom fields после валидации
     */
    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated($key, $default), [
            'description' => $this['title'],
            'slug'        => $this->generateSlug($this['title']),
            'body'        => clean($this['body'], 'youtube')
        ]);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function generateSlug(string $string)
    {
        $string = Str::slug($string);

        while (Product::where('slug', $string)->exists()) {
            $string .= Str::lower(Str::random(1));
        }

        return $string;
    }
}
