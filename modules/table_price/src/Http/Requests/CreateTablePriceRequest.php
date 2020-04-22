<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 17/03/2019
 * Time: 01:07
 */

namespace TablePrice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTablePriceRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
        ];
    }

    /***
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống',
            'price.required' => 'Giá gốc không được bỏ trống'
        ];
    }
}