<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:48 AM
 */

namespace Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Menu\Hook\HistoryMenuHook;
use Menu\Hook\MenuHook;

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
        add_action('lito-register-menu', [MenuHook::class, 'handle'], 55);
        add_action('lito_before_create_menu', [HistoryMenuHook::class, 'createHis'], 21);
        add_action('lito_before_edit_menu', [HistoryMenuHook::class, 'createHis'], 22);
        add_action('lito_before_delete_menu', [HistoryMenuHook::class, 'createHis'], 23);
    }
}