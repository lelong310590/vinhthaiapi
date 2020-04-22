<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:28
 */

namespace Seo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'SEO Manager';

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
                'name' => 'seo_index',
                'display_name' => 'Xem thông tin Seo Manager',
                'description' => 'Phân quyền cho phép xem thông tin Seo Manager'
            ]
        ];


        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

    }
}