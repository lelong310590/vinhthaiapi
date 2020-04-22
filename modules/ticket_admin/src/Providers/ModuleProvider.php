<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:10 PM
 */

namespace TicketAdmin\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-ticket-admin');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
    }
}