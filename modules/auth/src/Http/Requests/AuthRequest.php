<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 10:47 PM
 */

namespace Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		return [
			'username' => 'required|string',
			'password' => 'required|string'
		];
	}
	
	public function messages()
	{
		return [
			'username.required' => trans('auth::auth.usernameRequired'),
			'password.required' => trans('auth::auth.passwordRequired')
		];
	}
}