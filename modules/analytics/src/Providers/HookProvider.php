<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 14:16
 */

namespace Analytics\Providers;

use Analytics\Hook\AnalyticsWidgetHook;
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
        add_action('lito-register-dashboard-widget', [AnalyticsWidgetHook::class, 'handle'], 20);
    }
}