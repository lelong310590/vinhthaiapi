<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 10:58 PM
 */

namespace Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Base\Supports\Helper;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(255);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-dashboard');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'laravel-filemanager');

        $this->publishes([
            __DIR__ . '/../../resources/public' => public_path(),
        ], 'lito-public-assets');

        $this->app->booted(function () {
            $this->booted();
        });
    }

    public function booted()
    {
        $currentUrl = url()->current();
    }

    public function register()
    {
        //Load helpers
        Helper::loadModuleHelpers(__DIR__);

        config([
            'auth.defaults' => [
                'guard' => 'lito',
                'passwords' => 'admin-users',
            ],
            'auth.guards.lito' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'auth.providers.admin-users' => [
                'driver' => 'eloquent',
                'model' => \Users\Models\Users::class,
                'table' => 'users'
            ],
            'auth.passwords.admin-users' => [
                'provider' => 'admin-users',
                'table' => 'password_resets',
                'expire' => 60,
            ],
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../config/base.php', 'base');
        $this->mergeConfigFrom(__DIR__ . '/../../config/lfm.php', 'lfm');
        $this->mergeConfigFrom(__DIR__ . '/../../config/messages.php', 'messages');

        $this->publishes([
            __DIR__ . '/../../../../vendor/unisharp/laravel-filemanager/public' => public_path('vendor/laravel-filemanager'),
        ], 'public');

        /**
         * Module provider
         */
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);


        //Register related facades
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        $loader->alias('Image', \Intervention\Image\Facades\Image::class);
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);
        $loader->alias('Analytics', \Spatie\Analytics\AnalyticsFacade::class);
        /**
         * Other packages
         */
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->register(\Prettus\Repository\Providers\RepositoryServiceProvider::class);
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->app->register(\Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class);
        $this->app->register(\Spatie\Analytics\AnalyticsServiceProvider::class);
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        $this->app->register(\Spatie\Analytics\AnalyticsServiceProvider::class);
        //$this->app->register(\Spatie\Sitemap\SitemapServiceProvider::class);
        $this->app->register(\willvincent\Rateable\RateableServiceProvider::class);
        $this->app->register(\Ixudra\Curl\CurlServiceProvider::class);

        /**
         * Other module providers
         */
        $this->app->register(\Plugin\Providers\ModuleProvider::class);
        $this->app->register(\Auth\Providers\ModuleProvider::class);
        $this->app->register(\Hook\Providers\ModuleProvider::class);
        $this->app->register(\Users\Providers\ModuleProvider::class);
        $this->app->register(\Acl\Providers\ModuleProvider::class);
        $this->app->register(\Media\Providers\ModuleProvider::class);
        $this->app->register(\Analytics\Providers\ModuleProvider::class);
        $this->app->register(\Menu\Providers\ModuleProvider::class);
        $this->app->register(\Taxonomy\Providers\ModuleProvider::class);
        $this->app->register(\Post\Providers\ModuleProvider::class);
		$this->app->register(\Setting\Providers\ModuleProvider::class);
        $this->app->register(\TablePrice\Providers\ModuleProvider::class);
        $this->app->register(\Testimonial\Providers\ModuleProvider::class);
        $this->app->register(\Faqs\Providers\ModuleProvider::class);
        $this->app->register(\Product\Providers\ModuleProvider::class);
        $this->app->register(\Contact\Providers\ModuleProvider::class);
        $this->app->register(\Slider\Providers\ModuleProvider::class);
        $this->app->register(\Comment\Providers\ModuleProvider::class);
        $this->app->register(\History\Providers\ModuleProvider::class);
        //$this->app->register(\Seo\Providers\ModuleProvider::class);
		$this->app->register(\Ticket\Providers\ModuleProvider::class);
		//$this->app->register(\TicketAdmin\Providers\ModuleProvider::class);
		$this->app->register(\Mail\Providers\ModuleProvider::class);
    }
}
