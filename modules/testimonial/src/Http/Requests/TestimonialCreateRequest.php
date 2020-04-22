<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 20/03/2019
 * Time: 13:45
 */

namespace Testimonial\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialCreateRequest extends FormRequest
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
        ];
    }

    /***
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được bỏ trống',
        ];
    }
}