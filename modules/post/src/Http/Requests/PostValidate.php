<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 3:34 PM
 */

namespace Post\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PostValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_title' => 'required',
            'post_slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'post_title.required' => 'Tên danh mục không được bỏ trống',
            'post_slug.required' => 'Chưa có đường dẫn tĩnh'
        ];
    }
}