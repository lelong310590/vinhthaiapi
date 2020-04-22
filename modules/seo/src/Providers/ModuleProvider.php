<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:23
 */

namespace Seo\Providers;

use Illuminate\Support\ServiceProvider;
use Seo\Hook\RouteProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-seo');
    }

    public function register()
    {
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
        $this->app->register(RouteProvider::class);
    }
}