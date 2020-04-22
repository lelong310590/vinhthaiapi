<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:16 AM
 */

namespace Post\Providers;

use Illuminate\Support\ServiceProvider;
use Post\Hook\HistoryPostHook;
use Post\Hook\NhathuocHook;
use Post\Hook\PageHook;
use Post\Hook\PostHook;
use Post\Hook\PostWidgetHook;
use Post\Hook\QuickCreatePostHook;

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
        add_action('lito-register-menu', [PostHook::class, 'handle'], 5);
        add_action('lito-register-menu', [PageHook::class, 'handle'], 15);
        add_action('lito-register-dashboard-widget', [PostWidgetHook::class, 'handle'], 10);
        add_action('lito_before_create_post', [HistoryPostHook::class, 'createHis'], 21);
        add_action('lito_before_edit_post', [HistoryPostHook::class, 'createHis'], 22);
        add_action('lito_before_delete_post', [HistoryPostHook::class, 'createHis'], 23);
        add_action('lito-quick-create-menu', [QuickCreatePostHook::class, 'handle'], 1);
    }
}