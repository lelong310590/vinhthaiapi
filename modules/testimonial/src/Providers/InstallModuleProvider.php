<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:04
 */

namespace Testimonial\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Testimonial';

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
                'name' => 'testimonial_index',
                'display_name' => 'Xem danh sách ý kiến khách hàng',
                'description' => 'Xem danh sách các ý kiến khách hàng trong hệ thống'
            ],
            [
                'name' => 'testimonial_create',
                'display_name' => 'Thêm ý kiến khách hàng mới',
                'description' => 'Thêm ý kiến khách hàng mới'
            ],
            [
                'name' => 'testimonial_edit',
                'display_name' => 'Sửa ý kiến khách hàng',
                'description' => 'Sửa ý kiến khách hàng'
            ],
            [
                'name' => 'testimonial_delete',
                'display_name' => 'Xóa ý kiến khách hàng',
                'description' => 'Xóa ý kiến khách hàng'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}