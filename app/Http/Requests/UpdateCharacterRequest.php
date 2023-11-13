<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'alias' => 'sometimes|required|string|max:255',
            'superpowers' => 'sometimes|string',
            'firstAppearance' => 'sometimes|required|string|max:255',
            'movie_ids' => 'sometimes|array',
            'movie_ids.*' => 'exists:movies,id',
        ];
    }
}
