<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:47 PM
 */

namespace Slider\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Slider';

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
                'name' => 'slider_index',
                'display_name' => 'Xem danh sách slide',
                'description' => 'Phân quyền cho phép xem danh sách slide'
            ],
            [
                'name' => 'slider_create',
                'display_name' => 'Thêm mới slide',
                'description' => 'Phân quyền cho phép thêm mới slide'
            ],
            [
                'name' => 'slider_edit',
                'display_name' => 'Sửa slide',
                'description' => 'Phân quyền cho phép sửa slide'
            ],
            [
                'name' => 'slider_delete',
                'display_name' => 'Xóa slide',
                'description' => 'Phân quyền cho phép xóa slide'
            ]
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}