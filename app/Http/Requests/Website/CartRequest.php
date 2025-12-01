<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'variant_id' => 'required|exists:product_variants,id' ,
            'product_id' => 'required|exists:products,id'
        ];
    }

    public function messages()
    {
        return [
            'variant_id.required' => 'يجب اختيار مواصفات المنتج اولا',
            'variant_id.exists' => 'يجب اختيار مواصفات المنتج اولا',
            'product_id.required' => 'هذا المنتج غير متاح الان',
            'product_id.exists' => 'هذا المنتج غير متاح الان',
        ];
    }
}
