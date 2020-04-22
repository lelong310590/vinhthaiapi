<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 3:42 PM
 */

namespace Post\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Post';

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
                'name' => 'post_index',
                'display_name' => 'Xem danh sách bài viết',
                'description' => 'Phân quyền cho phép xem danh sách tất cả bài viết'
            ],
            [
                'name' => 'post_create',
                'display_name' => 'Thêm mới ài viết',
                'description' => 'Cho phép tài khoản thêm mới bài viết'
            ],
            [
                'name' => 'post_edit',
                'display_name' => 'Sửa bài viết',
                'description' => 'Cho phép tài khoản quyền sửa bài viếtc'
            ],
            [
                'name' => 'post_delete',
                'display_name' => 'Xóa bài viết',
                'description' => 'Cho phép tài khoản xóa bài viết'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}