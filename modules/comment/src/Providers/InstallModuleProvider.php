<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:30 PM
 */

namespace Comment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Comment';

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
                'name' => 'comment_index',
                'display_name' => 'Xem danh sách comment',
                'description' => 'Phân quyền cho phép xem danh sách tất cả comment'
            ],
            [
                'name' => 'comment_create',
                'display_name' => 'Thêm mới comment',
                'description' => 'Cho phép tài khoản thêm mới comment'
            ],
            [
                'name' => 'comment_edit',
                'display_name' => 'Sửa comment',
                'description' => 'Cho phép tài khoản quyền sửa comment'
            ],
            [
                'name' => 'comment_delete',
                'display_name' => 'Xóa comment',
                'description' => 'Cho phép tài khoản xóa comment'
            ]
        ];


        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}