<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 12:01 PM
 */
if (!function_exists('acl_data')) {
	function acl_data($data)
	{
		$model = new \Acl\Models\Role;
		
		foreach ($data as $d) {
			$avaiable = $model->where('name', $d['name'])->first();
			if (empty($avaiable)) {
				$model->name = $d['name'];
				$model->display_name = $d['display_name'];
				$model->description = $d['description'];
				$model->save();
			}
		}
	}
}

if (!function_exists('acl_permission')) {
	function acl_permission($module, $data)
	{
		if (Schema::hasTable('permissions')) {
			$model = new \Acl\Models\Permission;
			foreach ($data as $d) {
				$avaiable = $model->where('name', $d['name'])->first();
				if (empty($avaiable)) {
					$model->name = $d['name'];
					$model->display_name = $d['display_name'];
					$model->description = $d['description'];
					$model->module = $module;
					$model->save();
				}
			}
		}
	}
}

if (!function_exists('acl_user_role')) {
	function acl_user_role()
	{
		if (Schema::hasTable('role_user')) {
			$role = \Acl\Models\Role::where('name', 'administrator')->fist();
			$admin = \Users\Models\Users::where('email', 'admin@3sgroup.vn')->first();
			if (!empty($admin) && !empty($role)) {
				$admin->attachRoles($role);
			}
		}
	}
}

if (!function_exists('acl_role_permission')) {
	function acl_role_permission()
	{
		if (Schema::hasTable('permission_role')) {
			$role = \Acl\Models\Role::where('name', 'administrator')->first();
			$permission = \Acl\Models\Permission::get();
			if (!empty($role)) {
				$role->attachPermissions($permission);
			}
		}
	}
}

if (!function_exists('register_module')) {
    function register_module($data) {
        if (Schema::hasTable('plugin'))
        {
            $plugin = \Plugin\Models\Plugin::where([
                'name' => $data['name'],
                'description' => $data['description'],
                'path' => $data['path']
            ])->first();

            if (empty($plugin)) {
                $model = new \Plugin\Models\Plugin();
                $model->name = $data['name'];
                $model->description = $data['description'];
                $model->path = $data['path'];
                $model->save();
            }
        }
    }
}