<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 3:55 PM
 */

namespace Slider\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SliderValidate extends FormRequest
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
            'name.required' => 'Tên slide không được bỏ trống'
        ];
    }

}