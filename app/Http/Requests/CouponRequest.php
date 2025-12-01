<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|max:20',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric',
            'max_uses' => 'required|numeric',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'min_order_amount' => 'nullable|numeric' ,
        ];
    }
}
