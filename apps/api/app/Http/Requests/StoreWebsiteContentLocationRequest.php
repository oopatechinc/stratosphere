<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebsiteContentLocationRequest extends FormRequest
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
            'website_contents' => 'required|array',
            'website_contents.*.website_template_id' => 'required|exists:website_templates,id',
            'website_contents.*.location_id' => 'required|exists:locations,id',
            'website_contents.*.type' => 'required|string',
            'website_contents.*.is_group' => 'required|boolean',
            'website_contents.*.key' => 'required|string',
            'website_contents.*.value' => 'nullable',
        ];
    }
}
