<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/23/2019
 * Time: 11:30 AM
 */

namespace Slider\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GroupSlideValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên loại slide không được bỏ trống'
        ];
    }
}