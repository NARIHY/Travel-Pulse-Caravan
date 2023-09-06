<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'exists:categories,id'],
            'content' => ['required', 'min:3'],
            'media' => [
                'mimetypes:video/mp4,video/mov,video/avi,image/jpeg,image/png,image/jpg,image/gif', // Types de médias acceptés
                'max:512000000', // Taille maximale des médias (5 Go)
            ],
        ];
    }
}
