<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
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
            'theme_id' => 'nullable|int|exists:themes,id',
            'vertical_id' => 'nullable|int|exists:verticals,id',
            'timezone_id' => 'nullable|int|exists:timezones,id',
            'language_id' => 'nullable|int|exists:languages,id',
            'name' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'registry_id' => 'nullable|int',
            'email' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}
