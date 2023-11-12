<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'dateOfBirth' => 'sometimes|required|date',
            'nationality' => 'sometimes|required|string|max:255',
            'character_id' => 'sometimes|required|exists:characters,id|unique:actors,character_id,' . $this->actor,
        ];
    }
}
