<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:06 PM
 */

namespace Contact\Providers;


use Contact\Hook\ContactHook;
use Contact\Hook\ContactNotificationHook;
use Contact\Hook\ContactWidgetHook;
use Contact\Hook\HistoryContactHook;
use Illuminate\Support\ServiceProvider;

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
        add_action('lito-register-menu', [ContactHook::class, 'handle'], 25);
        add_action('lito-register-dashboard-widget', [ContactWidgetHook::class, 'handle'], 15);
        add_action('lito-register-header-notification', [ContactNotificationHook::class, 'handle'], 5);
        add_action('lito_before_create_contact_group', [HistoryContactHook::class, 'createHis'], 1);
        add_action('lito_before_edit_contact_group', [HistoryContactHook::class, 'createHis'], 1);
        add_action('lito_before_delete_contact_group', [HistoryContactHook::class, 'createHis'], 1);
    }
}