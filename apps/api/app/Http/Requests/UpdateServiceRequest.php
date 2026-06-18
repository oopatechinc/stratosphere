<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'show_price' => 'nullable|boolean',
            'description' => 'nullable|string',
            'appointment_length_decider' => 'nullable|string',
            'appointment_length' => 'nullable|integer',
            'minimum_appointment_length' => 'nullable|integer',
            'maximum_appointment_length' => 'nullable|integer',
            'is_subscription' => 'nullable|boolean',
            'subscription_period_id' => 'nullable|required_if:is_subscription,true|nullable|integer|exists:subscription_periods,id',
            'subscription_trial_period_in_days' => 'nullable|integer',
        ];
    }
}
