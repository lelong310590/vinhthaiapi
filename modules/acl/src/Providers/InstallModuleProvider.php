<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 11:55 AM
 */

namespace Acl\Providers;

use Acl\Models\Permission;
use Acl\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use Users\Models\Users;

class InstallModuleProvider extends ServiceProvider
{
	protected $module = 'Acl';
	
	public function boot()
	{
		app()->booted(function () {
			$this->booted();
		});
	}
	
	public function register()
	{
	
	}
	
	private function booted()
	{
		$permission = [
			[
				'name' => 'access_dashboard',
				'display_name' => 'Truy cập quản trị',
				'description' => 'Truy cập quản trị'
			],
			[
				'name' => 'role_index',
				'display_name' => 'Xem danh sách vai trò',
				'description' => 'Xem danh sách các vai trò trong hệ thống'
			],
			[
				'name' => 'role_create',
				'display_name' => 'Thêm vai trò mới',
				'description' => 'Thêm vai trò mới'
			],
			[
				'name' => 'role_edit',
				'display_name' => 'Sửa vai trò',
				'description' => 'Sửa vai trò'
			],
			[
				'name' => 'role_delete',
				'display_name' => 'Xóa vai trò',
				'description' => 'Xóa vai trò'
			],
			[
				'name' => 'permission_index',
				'display_name' => 'Xem danh sách quyền',
				'description' => 'Xem danh sách các quyền trong hệ thống'
			]
		];
		
		if (Schema::hasTable('permissions')) {
			acl_permission($this->module, $permission);
		}

		try {
            $roleModel = new Role;
            $rolePerms = new Permission;
            $allPerms = $rolePerms->select('id')->get();
            $roleAdmin = $roleModel->where('name', 'administrator')->first();

            if (!empty($roleAdmin)) {
                $roleAdmin->perms()->sync($allPerms);
            }

        } catch (\Exception $e) {
            //return $e->getMessage();
        }

	}
}
