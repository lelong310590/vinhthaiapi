<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:17
 */

namespace Plugin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Plugin';

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
                'name' => 'plugin_index',
                'display_name' => 'Xem danh sách Module',
                'description' => 'Phân quyền cho phép xem danh sách Module'
            ],
            [
                'name' => 'plugin_edit',
                'display_name' => 'Sửa Module',
                'description' => 'Phân quyền cho phép sửa Module'
            ]
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}