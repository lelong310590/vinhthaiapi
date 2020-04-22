<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:19 PM
 */

namespace Contact\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Contact';
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
                'name' => 'contact_index',
                'display_name' => 'Xem danh sách liên hệ',
                'description' => 'Phân quyền cho phép xem danh sách tất cả liên hệ'
            ],
            [
                'name' => 'contact_delete',
                'display_name'=> 'Xóa liên hệ',
                'description' => 'Phân quyền cho phép xóa liên hệ'
            ],
            [
                'name' => 'contact_view',
                'display_name'=> 'Xem chi tiết liên hệ',
                'description' => 'Phân quyền cho phép xem chi tiết tin liên hệ'
            ],
            [
                'name' => 'contact_create',
                'display_name'=> 'Tạo Form liên hệ',
                'description' => 'Phân quyền cho phép tạo form liên hệ'
            ],
            [
                'name' => 'contact_edit',
                'display_name'=> 'Sửa Form liên hệ',
                'description' => 'Phân quyền cho phép sửa form liên hệ'
            ]

        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}