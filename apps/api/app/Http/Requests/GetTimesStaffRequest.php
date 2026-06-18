<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetTimesStaffRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location_id' => 'required|integer|exists:locations,id',
            'date' => 'required|date',
            'customer_timezone_id' => 'required|integer|exists:timezones,id',
            'service_variation_ids' => 'required|string',
        ];
    }
}
