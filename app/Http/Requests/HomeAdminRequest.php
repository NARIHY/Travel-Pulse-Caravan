<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeAdminRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'media' => [
                'required_without_all:media', // Au moins un média (image ou vidéo) doit être présent
                'mimetypes:video/mp4,video/mov,video/avi,image/jpeg,image/png,image/jpg,image/gif', // Types de médias acceptés
                'max:512000000', // Taille maximale des médias (5 Go)
            ],
        ];
        
    }
    
}
