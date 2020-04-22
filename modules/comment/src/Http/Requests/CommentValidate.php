<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:47 PM
 */

namespace Comment\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CommentValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'email.required' => 'Bạn chưa nhập email'
        ];
    }
}