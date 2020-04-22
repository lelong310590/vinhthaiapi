<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 2:15 PM
 */
if (!function_exists('user_data')) {
	function user_data($data)
	{
		$model = new \Users\Models\Users;
		
		foreach ($data as $d) {
			$avaiable = $model->where('email', $d['email'])->first();
			if (empty($avaiable)) {
				$model->email = $d['email'];
				$model->password = $d['password'];
				$model->username = $d['username'];
				$model->thumbnail = $d['thumbnail'];
				$model->status = $d['status'];
				$model->full_name = $d['full_name'];
				$model->save();
			}
		}
	}
}


if (!function_exists('add_user_to_role')) {
	function add_user_to_role($email)
	{
		$model = new \Users\Models\Users;
		$role = new \Acl\Models\Role;
		$adminRole = $role->where('name', 'administrator')->first();
		$user = $model->where('email', $email)->first();
		if (!empty($user) && !empty($adminRole)) {
			$user->roles()->sync($adminRole->id);
		}
	}
}
