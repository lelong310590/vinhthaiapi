<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 4:16 PM
 */

namespace Menu\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MenuNodeValidate extends FormRequest
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
            'name.required' => 'Tên loại menu không được bỏ trống'
        ];
    }

}