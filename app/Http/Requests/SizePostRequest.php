<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizePostRequest extends FormRequest
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
            'name_letter'=>'required',
            'name_number'=>'required|numeric',
            'status'=>'required'
        ];
    }
    public function messages(){
        return [
            'name_letter.required'=>'Ten size khong duoc de trong',
            'name_number.required'=>'Vui long nhap so size',
            'name_number.numeric'=>'So size phai la so',
            'status.required'=>'Vui long chon trang thai'
        ];
    }
}
