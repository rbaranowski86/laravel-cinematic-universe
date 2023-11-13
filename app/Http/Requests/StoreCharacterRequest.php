<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'superpowers' => 'sometimes|string',
            'firstAppearance' => 'required|string|max:255',
            'movie_ids' => 'sometimes|array',
            'movie_ids.*' => 'exists:movies,id',
        ];
    }
}
