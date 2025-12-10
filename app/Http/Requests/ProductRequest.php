<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    public function rules(): array
    {
        return [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:320' ,
                'price' => 'required|numeric',
                'compare_price' => 'required|numeric' ,
                'image' => 'image|mimes:png,jpg',
                'category_id' => 'required|exists:categories,id',
        ];
    }
}
