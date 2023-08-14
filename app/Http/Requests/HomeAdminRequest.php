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
            'video' => ['required_without_all:picture', 'mimetypes:video/mp4,video/mov,video/avi', 'max:100000'],
            'picture' => [ 'required_without_all:video', 'image', 'max:10000']
        ];
    }
    
}
