<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'place_depart' => ['required', 'exists:travel,place', 'different:place_arrivals'],
            'place_arrivals' => ['required', 'exists:travel,place', 'different:place_depart'],
            'date_depart' => ['required', 'date', 'after:now'],
            'heure_depart' => ['required', 'date_format:H:i'],
            'status' => ['required', 'exists:statuses,status'],
            'price' => ['required', 'min:5']
        ];
    }
}
