<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 9:55 PM
 */

namespace Product\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Product';
    protected $cate = 'Category';

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
                'name' => 'product_index',
                'display_name' => 'Xem danh sách sản phẩm',
                'description' => 'Phân quyền cho phép xem danh sách tất cả sản phẩm'
            ],
            [
                'name' => 'product_create',
                'display_name' => 'Thêm mới sản phẩm',
                'description' => 'Cho phép tài khoản thêm mới sản phẩm'
            ],
            [
                'name' => 'product_edit',
                'display_name' => 'Sửa sản phẩm',
                'description' => 'Cho phép tài khoản quyền sửa sản phẩm'
            ],
            [
                'name' => 'product_delete',
                'display_name' => 'Xóa sản phẩm',
                'description' => 'Cho phép tài khoản xóa sản phẩm'
            ]
        ];

        $catePermission = [
            [
                'name' => 'category_index',
                'display_name' => 'Xem danh sách danh mục sản phẩm',
                'description' => 'Cho phép tài khoản xem danh mục sản phẩm'
            ],
            [
                'name' => 'category_create',
                'display_name' => 'Thêm mới danh mục sản phẩm',
                'description' => 'Cho phép tài khoản thêm mới danh mục sản phẩm'
            ],
            [
                'name' => 'category_edit',
                'display_name' => 'Sửa danh mục sản phẩm',
                'description' => 'Cho phép tài khoản quyền sửa danh mục sản phẩm'
            ],
            [
                'name' => 'category_delete',
                'display_name' => 'Xóa danh mục sản phẩm',
                'description' => 'Cho phép tài khoản xóa danh mục sản phẩm'
            ]
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
            acl_permission($this->cate,$catePermission);
        }

    }

}