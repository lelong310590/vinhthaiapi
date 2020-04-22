<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 4:00 PM
 */

namespace Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Setting';
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
                'name' => 'setting_site',
                'display_name' => 'Sửa cấu hình chung',
                'description' => 'Phân quyền cho phép sửa cấu hình website'
            ]
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}