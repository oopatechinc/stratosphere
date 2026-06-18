<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceVariationRequest extends FormRequest
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
            'variations' => 'required|array',
            'variations.*.service_id' => 'required|exists:services,id',
            'variations.*.name' => 'required|string',
            'variations.*.price' => 'required|numeric',
            'variations.*.duration' => 'required|numeric',
        ];
    }
}
