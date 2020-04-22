<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 9:51 PM
 */

namespace Product\Providers;


use Illuminate\Support\ServiceProvider;
use Product\Hook\ProductHook;

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
        add_action('lito-register-menu', [ProductHook::class, 'handle'], 42);
        //add_action('lito-register-dashboard-widget', [PostWidgetHook::class, 'handle'], 10);
    }
}