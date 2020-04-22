<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/02/2019
 * Time: 15:29
 */

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = intval($this->get('current_id'));

        return [
            'username' => 'required|unique:users,username,'.$id.',id',
            'email' => 'required|unique:users,email,'.$id.',id',
            'repassword' => 'same:password',
            'full_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên đăng nhập không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'full_name.required' => 'Họ và tên không được bỏ trống',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'email.unique' => 'Email nhập đã được sử dụng',
            'repassword.same' => 'Mật khẩu xác nhận không đúng',
        ];
    }
}