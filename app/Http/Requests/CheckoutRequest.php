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
        'email' => 'nullable|email|max:255',
        'phone' =>  ['required', 'regex:/^01[0125][0-9]{8}$/'],
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'zip' => 'nullable|string|max:20',
        'country' => 'required|string|max:100',
        'payment' => 'required|in:Credit Card,Cash on Delivery',
        'card_number' =>  'exclude_unless:payment,Credit Card|required|digits:16',
        'expiry' => [
                         'exclude_unless:payment,Credit Card',
                         'required',
                         'date_format:m/y',
                           function ($attribute, $value, $fail) {
                                $expiry = \Carbon\Carbon::createFromFormat('!m/y', $value)
                                  ->endOfMonth();

                                if ($expiry->isPast()) {
                                      $fail('The card expiry date must be in the future.');
                                      }
                                  },
                              ],
        'cvv' =>'exclude_unless:payment,Credit Card|required|digits:3',
        ];
    }
}
