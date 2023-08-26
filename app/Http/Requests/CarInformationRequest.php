<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarInformationRequest extends FormRequest
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
            'car' => ['required', 'exists:cars,id'],
            'kilometers'=> ['required', 'numeric'],
            'max_fuel' => ['required', 'numeric', 'max:100'],
            'min_weight' => ['required', 'numeric'],
            'max_weight' => ['required', 'numeric'],
            'maintains' => ['required', 'date', 'after:now']
        ];
    }
}
