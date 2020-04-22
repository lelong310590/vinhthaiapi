<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 14:06
 */

namespace Analytics\Providers;

use Illuminate\Support\ServiceProvider;
use Base\Supports\Helper;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-analytics');
    }

    public function register()
    {
        Helper::loadModuleHelpers(__DIR__);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Analytics', \Spatie\Analytics\AnalyticsFacade::class);
        $this->app->register(HookProvider::class);
    }
}