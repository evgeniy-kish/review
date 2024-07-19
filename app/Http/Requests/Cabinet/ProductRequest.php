<?php

namespace App\Http\Requests\Cabinet;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:3', 'max:250'],
            'img'         => ['string', 'max:250'],
            'description' => ['string', 'max:500'],
            'body'        => ['required', 'string']
        ];
    }
}