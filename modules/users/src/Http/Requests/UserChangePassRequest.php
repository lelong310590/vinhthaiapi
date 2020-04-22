<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/4/2019
 * Time: 3:04 PM
 */

namespace Users\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserChangePassRequest extends FormRequest
{
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
            'password' => 'required|min:6',
            'repassword' => 'required|same:password'
        ];
    }

    /***
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.same' => 'Mật khẩu xác nhận không đúng',
        ];
    }
}