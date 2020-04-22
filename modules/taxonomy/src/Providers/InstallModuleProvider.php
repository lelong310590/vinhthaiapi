<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:36 AM
 */

namespace Taxonomy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Taxonomy';

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
                'name' => 'taxonomy_index',
                'display_name' => 'Xem danh sách danh mục',
                'description' => 'Phân quyền cho phép xem danh sách tất cả danh mục'
            ],
            [
                'name' => 'taxonomy_create',
                'display_name' => 'Thêm mới danh mục',
                'description' => 'Cho phép tài khoản thêm mới danh mục'
            ],
            [
                'name' => 'taxonomy_edit',
                'display_name' => 'Sửa danh mục',
                'description' => 'Cho phép tài khoản quyền sửa danh mục'
            ],
            [
                'name' => 'taxonomy_delete',
                'display_name' => 'Xóa danh mục',
                'description' => 'Cho phép tài khoản xóa danh mục'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }

}