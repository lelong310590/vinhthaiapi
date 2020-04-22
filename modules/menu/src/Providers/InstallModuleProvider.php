<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:54 AM
 */

namespace Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Menu';
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    public function register()
    {

    }

    public function booted()
    {
        $permission = [
            [
                'name' => 'menu_index',
                'display_name' => 'Xem danh sách menu',
                'description' => 'Phân quyền cho phép xem danh sách tất menu'
            ],
            [
                'name' => 'menu_create',
                'display_name' => 'Thêm mới menu',
                'description' => 'Cho phép tài khoản thêm mới menu'
            ],
            [
                'name' => 'menu_edit',
                'display_name' => 'Sửa menu',
                'description' => 'Cho phép tài khoản quyền sửa menu'
            ],
            [
                'name' => 'menu_delete',
                'display_name' => 'Xóa menu',
                'description' => 'Cho phép tài khoản xóa menu'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}