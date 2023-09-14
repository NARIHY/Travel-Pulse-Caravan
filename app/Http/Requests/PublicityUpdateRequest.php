<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicityUpdateRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3'],
            'media[]' => [
                'array', //for uploading many files
                'min:1',
                'max:3',
                'mimetypes:video/mp4,video/quicktime,video/x-msvideo,image/jpeg,image/png,image/jpg', // Types de médias acceptés
                'max:512000000', // Taille maximale des médias (5 Go)
            ],
        ];
    }
}
