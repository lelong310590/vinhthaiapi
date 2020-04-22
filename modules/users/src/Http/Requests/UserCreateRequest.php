<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/02/2019
 * Time: 10:23
 */

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'full_name' => 'required',
            'phone' => 'required',
        ];
    }

    /***
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Tên đăng nhập không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'full_name.required' => 'Họ và tên không được bỏ trống',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'email.unique' => 'Email nhập đã được sử dụng',
            'repassword.same' => 'Mật khẩu xác nhận không đúng',
        ];
    }
}