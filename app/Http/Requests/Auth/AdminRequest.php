<?php

namespace App\Http\Requests\Auth ;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|min:5' ,
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:5',
            'role' => 'required|in:owner,admin,super_admin',
            'address' => 'required|string',
            'phone' => 'required|numeric|digits_between:11,11'
        ];
    }

    public function messages() :array
    {
        return [
            'name.required' => 'الاسم مطلوب ويجب أن لايقل عن 5 أحرف' ,
            'name.min' => 'الاسم مطلوب ويجب أن لايقل عن 5 أحرف' ,
            'email.required' => 'البريد الالكتروني مطلوب ويجب أن يكون موجود بالفعل',
            'password.required' => ' كلمة السر مطلوبة ويجب أن لاتقل عن 5 أحرف',
            'password.min' => ' كلمة السر مطلوبة ويجب أن لاتقل عن 5 أحرف',
            'role.required' => 'دور المشرف مطلوب',
            'role.in' => 'دور المشرف يجب أن يكون من ضمن الاختيارات المتاحة',
            'address.required' => 'العنوان مطلوب ويجب أن لايقل عن 5 أحرف',
            'phone.required' => 'رقم التليفون مطلوب ويجب أن لايقل عن 5 أحرف'
        ];
    }

}
