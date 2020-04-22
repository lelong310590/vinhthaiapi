<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:00 PM
 */

namespace TicketAdmin\Providers;

use Illuminate\Support\ServiceProvider;
use TicketAdmin\Hook\TicketAdminHook;

class HookProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->booted();
        });
    }

    public function register()
    {

    }

    private function booted()
    {
        add_action('lito-register-menu', [TicketAdminHook::class, 'handle'], 93);
        //add_action('lito_before_create_ticket', [HistoryTicketHook::class, 'createHis'], 35);
        //add_action('lito_before_edit_ticket', [HistoryTicketHook::class, 'createHis'], 36);
        //add_action('lito_before_delete_ticket', [HistoryTicketHook::class, 'createHis'], 37);
    }
}