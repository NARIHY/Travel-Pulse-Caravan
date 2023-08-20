<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
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
            'plate_number' => ['required', 'min:7', 'max:9'],
            'category' => ['required', 'exists:categories,id'],
            'year' => ['required', 'min:4', 'max:4'],
            'place' => ['required'],
            'vehicule_info' => ['required'],
            'media' => ['max: 10000']
        ];
    }
}
