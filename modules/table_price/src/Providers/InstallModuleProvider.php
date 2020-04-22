<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 14:58
 */

namespace TablePrice\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Table Price';

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
                'name' => 'table_price_index',
                'display_name' => 'Xem danh sách bảng giá',
                'description' => 'Xem danh sách các bảng giá trong hệ thống'
            ],
            [
                'name' => 'table_price_create',
                'display_name' => 'Thêm bảng giá mới',
                'description' => 'Thêm bảng giá mới'
            ],
            [
                'name' => 'table_price_edit',
                'display_name' => 'Sửa bảng giá',
                'description' => 'Sửa bảng giá'
            ],
            [
                'name' => 'table_price_delete',
                'display_name' => 'Xóa bảng giá',
                'description' => 'Xóa bảng giá'
            ],

            [
                'name' => 'table_price_group_index',
                'display_name' => 'Xem danh sách nhóm bảng giá',
                'description' => 'Xem danh sách các nhóm bảng giá trong hệ thống'
            ],
            [
                'name' => 'table_price_group_create',
                'display_name' => 'Thêm nhóm bảng giá mới',
                'description' => 'Thêm nhóm bảng giá mới'
            ],
            [
                'name' => 'table_price_group_edit',
                'display_name' => 'Sửa nhóm bảng giá',
                'description' => 'Sửa nhóm bảng giá'
            ],
            [
                'name' => 'table_price_group_delete',
                'display_name' => 'Xóa nhóm bảng giá',
                'description' => 'Xóa nhóm bảng giá'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}