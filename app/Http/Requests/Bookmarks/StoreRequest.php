<?php

namespace App\Http\Requests\Bookmarks;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'url' => [
                'required',
                'url',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'tags' => [
                'nullable',
                'string',
            ]
        ];
    }
}
