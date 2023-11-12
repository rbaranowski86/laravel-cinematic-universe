<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'director' => 'required|string|max:255',
            'boxOfficeEarnings' => 'required|numeric',
            'cinematic_universe_id' => 'required|exists:cinematic_universes,id',
        ];
    }
}
