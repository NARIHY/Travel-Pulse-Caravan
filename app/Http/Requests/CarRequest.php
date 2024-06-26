<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'model' => ['required', 'min:3'],
            'brand' => ['required', 'min:3'],
            'plate_number' => ['required', 'min:7', 'max:9','unique:cars'],
            'category' => ['required', 'exists:categories,id'],
            'year' => ['required', 'min:4', 'max:4'],
            'place' => ['required', 'exists:place_numbers,place'],
            'vehicule_info' => ['required', 'exists:statements,state'],
            'media' => ['required', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif', 'max: 10000']
        ];
    }
}
