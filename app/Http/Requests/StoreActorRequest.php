<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'nationality' => 'required|string|max:255',
            'character_id' => 'required|exists:characters,id|unique:actors,character_id',
        ];
    }
}
