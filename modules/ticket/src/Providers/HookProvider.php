<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 11:44 AM
 */

namespace Ticket\Providers;

use Illuminate\Support\ServiceProvider;
use Ticket\Hook\HistoryTicketHook;
use Ticket\Hook\TicketHook;
use Ticket\Hook\TicketNotificationHook;


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
        add_action('lito-register-menu', [TicketHook::class, 'handle'], 92);
        add_action('lito-register-header-notification', [TicketNotificationHook::class, 'handle'], 10);
        add_action('lito_before_create_ticket', [HistoryTicketHook::class, 'createHis'], 35);
        add_action('lito_before_edit_ticket', [HistoryTicketHook::class, 'createHis'], 36);
        add_action('lito_before_delete_ticket', [HistoryTicketHook::class, 'createHis'], 37);
    }
}