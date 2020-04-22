<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 2:56 PM
 */

namespace Menu\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MenuValidate extends FormRequest
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
            'name.required' => 'Tên loại menu không được bỏ trống',
            'slug.required' => 'Chưa có đường dẫn tĩnh'
        ];
    }
}