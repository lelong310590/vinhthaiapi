<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:32 PM
 */

namespace Comment\Providers;

use Barryvdh\Debugbar\ServiceProvider;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-comment');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
    }

}