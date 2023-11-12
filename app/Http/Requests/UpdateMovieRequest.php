<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'releaseDate' => 'sometimes|required|date',
            'director' => 'sometimes|required|string|max:255',
            'boxOfficeEarnings' => 'sometimes|required|numeric',
            'cinematic_universe_id' => 'sometimes|required|exists:cinematic_universes,id',
        ];
    }
}
