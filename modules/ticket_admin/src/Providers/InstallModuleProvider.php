<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:03 PM
 */

namespace TicketAdmin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Ticket Admin';

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
                'name' => 'ticket_admin_index',
                'display_name' => 'Xem danh sách ticket admin',
                'description' => 'Xem danh sách các ticket admin trong hệ thống'
            ],
            [
                'name' => 'ticket_admin_create',
                'display_name' => 'Thêm ticket admin mới',
                'description' => 'Thêm ticket admin mới'
            ],
            [
                'name' => 'ticket_admin_edit',
                'display_name' => 'Sửa ticket admin',
                'description' => 'Sửa ticket admin'
            ],
            [
                'name' => 'ticket_admin_delete',
                'display_name' => 'Xóa ticket admin',
                'description' => 'Xóa ticket admin khỏi hệ thống'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }

        $pluginRegister = [
            'name' => 'Ticket Admin',
            'description' => 'Quản lý hệ thống Ticket dành cho Lito',
            'path' => '\TicketAdmin\Providers\ModuleProvider::class',
        ];

        if (Schema::hasTable('plugin')) {
            register_module($pluginRegister);
        }
    }
}