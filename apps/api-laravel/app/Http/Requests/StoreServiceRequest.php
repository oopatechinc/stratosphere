<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'tenant_id' => 'required|integer|exists:tenants,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'variations' => 'nullable|array',
            'variations.*.name' => 'nullable|string',
            'variations.*.price' => 'required|numeric',
            'variations.*.duration' => 'required|numeric',
            ...Category::ARRAY_VALIDATION_RULES
        ];
    }
}
