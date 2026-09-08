<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        'mug_name'     => 'required|string|max:70',
        'price'        => 'required|numeric',
        'category_id' => 'required|exists:categories,id',


         'image' => match ($this->route()->getName())  {
             'products.store' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
             'products.update' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
              
         },
                


        'description'  => 'required|string',
        'capacity'     => 'required|string|max:255',
        'how_its_made' => 'required|string',
        'microwave'    => 'required|boolean',
        ];
    }
}
