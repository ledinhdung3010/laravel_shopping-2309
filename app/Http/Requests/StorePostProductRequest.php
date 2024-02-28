<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SalePriceValidate;

class StorePostProductRequest extends FormRequest
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
            'name'=>'required|min:2|max:150',
            'category_id'=>'required|numeric',
            'description'=>'required',
            'price'=>['numeric','required',new SalePriceValidate],
            'list_image'=>['required','max:2048'],
            'list_image.*'=>'mimes:jpg,png,svg',
            'quantity'=>'required|numeric',
            'status'=>'required',
            'color_id'=>'required',
            'size_id'=>'required',
            'tag_id'=>'required'
            

        ];
    }
    public function messages(){
        return [
            'name.required'=>'ten khong duoc de trong',
            'name.min'=>'ten khong duoc be hon 2 ky tu',
            'name.max'=>'ten khong duoc vuot qua 150 ky tu',
            'category_id.required'=>"vui long chon danh muc",
            'category_id.numeric'=>"Du lieu khong chinh xac",
            'description.required'=>'mo ta san pham khong duoc de trong',
            'price.required'=>'vui long nhap gia san pham',
            'price.numeric'=>'gia san pham phai la so',
            'list_image.required'=>'vui long chon anh san pham',
            'list_image.*.mimes'=>'dinh dang anh sai anh chap nhan jpg,svg,png',
            'list_image.max'=>'kich thuoc size qua lon',
            'quantity.required'=>'vui long so luong san pham',
            'quantity.numeric'=>'so luong san pham phai la so',
            'status.required'=>'vui long nhap trang thai',
            'color_id.required'=>'vui long chon color',
            'size_id.required'=>'vui long chon size',
            'tag_id.required'=>'vui long chon tag'

        ];
       

    }
}
