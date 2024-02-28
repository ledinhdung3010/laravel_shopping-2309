<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCustomerPayment extends FormRequest
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
            'full_name'=>'required',
            'phone'=>'required|numeric',
            'email'=>'required|email',
            'address'=>'required'
        ];
    }
    public function messages(){
        return [
            'full_name.required'=>'vui long nhap ten',
            'phone.required'=>'vui long nhap so dien thoai',
            'phone.numeric'=>'so dien thoai phai la so',
            'email.required'=>'email khong duoc de trong',
            'email.email'=>'dinh dang email sai',
            'address.required'=>'vui long nhap dia chi giao hang'

        ];
    }
}
