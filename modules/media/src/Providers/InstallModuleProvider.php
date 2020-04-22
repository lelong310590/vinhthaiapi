<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 11:22
 */

namespace Media\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Media';

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
                'name' => 'media_index',
                'display_name' => 'Xem danh sách nội dung đa phương tiện',
                'description' => 'Phân quyền cho phép xem danh sách tất cả nội dung đa phương tiện'
            ]
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}