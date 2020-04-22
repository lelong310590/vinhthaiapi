<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 11:46 PM
 */

namespace Product\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'slug.required' => 'Chưa có đường dẫn tĩnh'
        ];
    }
}