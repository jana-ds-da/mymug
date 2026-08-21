<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'full_name' => 'required|string|max:255',

        'email' => 'required|email|max:255',

        'phone' => 'required|digits:11',

        'address' => 'required|string|max:500',

        'city' => 'required|string|max:100',

        'state' => 'nullable|string|max:100',

        'zip' => 'nullable|string|max:20',

        'country' => 'required|string|max:100',

        'payment' => 'required|in:Credit Card,PayPal,Apple Pay',

        'card_number' => 'required_if:payment,Credit Card|digits:16',

        'expiry' => 'required_if:payment,Credit Card|date_format:m/y',

        'cvv' => 'required_if:payment,Credit Card|digits:3',
        ];
    }
}
