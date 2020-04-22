<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 10:10 PM
 */

namespace History\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends  ServiceProvider
{
    protected $module = 'History';
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
                'name' => 'history_index',
                'display_name' => 'Xem danh sách lịch sử',
                'description' => 'Phân quyền cho phép xem danh sách tất cả liên hệ'
            ]

        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}