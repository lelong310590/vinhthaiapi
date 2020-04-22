<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:19
 */

namespace Plugin\Providers;

use Illuminate\Support\ServiceProvider;
use Plugin\Hook\PluginHook;

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
        add_action('lito-register-menu', [PluginHook::class, 'handle'], 95);
    }
}