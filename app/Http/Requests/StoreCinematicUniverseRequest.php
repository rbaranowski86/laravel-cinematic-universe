<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCinematicUniverseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'foundationYear' => 'required|integer|min:1900|max:' . now()->year,
        ];
    }
}
