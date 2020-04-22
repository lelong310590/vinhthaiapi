<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 21/03/2019
 * Time: 11:32
 */

namespace Faqs\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'FAQs';

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
                'name' => 'faqs_index',
                'display_name' => 'Xem danh sách Nhóm Faqs',
                'description' => 'Phân quyền cho phép xem danh sách tất cả Nhóm Faqs'
            ],
            [
                'name' => 'faqs_create',
                'display_name' => 'Thêm mới Nhóm Faqs',
                'description' => 'Cho phép tài khoản thêm mới Nhóm Faqs'
            ],
            [
                'name' => 'faqs_edit',
                'display_name' => 'Sửa Nhóm Faqs',
                'description' => 'Cho phép tài khoản quyền sửa Nhóm Faqs'
            ],
            [
                'name' => 'faqs_delete',
                'display_name' => 'Xóa Nhóm Faqs',
                'description' => 'Cho phép tài khoản xóa Nhóm Faqs'
            ],

            [
                'name' => 'faqs_item_index',
                'display_name' => 'Xem danh sách FAQs',
                'description' => 'Phân quyền cho phép xem danh sách tất cả FAQs'
            ],
            [
                'name' => 'faqs_item_create',
                'display_name' => 'Thêm mới FAQs',
                'description' => 'Cho phép tài khoản thêm mới FAQs'
            ],
            [
                'name' => 'faqs_item_edit',
                'display_name' => 'Sửa FAQs',
                'description' => 'Cho phép tài khoản quyền sửa FAQs'
            ],
            [
                'name' => 'faqs_item_delete',
                'display_name' => 'Xóa FAQs',
                'description' => 'Cho phép tài khoản xóa FAQs'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}