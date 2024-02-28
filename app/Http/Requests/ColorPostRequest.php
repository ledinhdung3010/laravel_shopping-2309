<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorPostRequest extends FormRequest
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
            'name'=>'required',
            'color'=>'required',
            'status'=>'required'
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Tên màu không được để trống',
            'color.required'=>'Color không được để trống',
            'status.required'=>'Status không được để trống'        ];
    }
}
