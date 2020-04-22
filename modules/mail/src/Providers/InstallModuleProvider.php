<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:48 AM
 */

namespace Mail\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Mail';

    public function boot()
    {
        $this->app->booted(function () {
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
                'name' => 'mail_index',
                'display_name' => 'Xem danh sách mẫu mail',
                'description' => 'Xem danh sách mẫu mail'
            ],
            [
                'name' => 'mail_create',
                'display_name' => 'Tạo mới mẫu mail',
                'description' => 'Tạo mới mẫu mail'
            ],
            [
                'name' => 'mail_edit',
                'display_name' => 'Sửa mẫu email',
                'description' => 'Sửa mẫu email'
            ],
            [
                'name' => 'mail_delete',
                'display_name' => 'Xóa mẫu email',
                'description' => 'Xóa mẫu email'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}