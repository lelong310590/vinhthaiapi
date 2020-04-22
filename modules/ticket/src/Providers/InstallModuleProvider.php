<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 11:46 AM
 */

namespace Ticket\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Ticket';

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
                'name' => 'ticket_index',
                'display_name' => 'Xem danh sách ticket',
                'description' => 'Xem danh sách các ticket trong hệ thống'
            ],
            [
                'name' => 'ticket_create',
                'display_name' => 'Thêm ticket mới',
                'description' => 'Thêm ticket mới'
            ],
            [
                'name' => 'ticket_edit',
                'display_name' => 'Sửa ticket',
                'description' => 'Sửa ticket'
            ],
            [
                'name' => 'ticket_delete',
                'display_name' => 'Xóa ticket',
                'description' => 'Xóa ticket khỏi hệ thống'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

        $pluginRegister = [
            'name' => 'Ticket',
            'description' => 'Quản lý hệ thống Ticket',
            'path' => '\Ticket\Providers\ModuleProvider::class',
        ];

        if (Schema::hasTable('plugin')) {
            register_module($pluginRegister);
        }
    }
}