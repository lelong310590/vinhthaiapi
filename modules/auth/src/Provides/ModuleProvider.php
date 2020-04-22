<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:06 PM
 */

namespace Auth\Providers;

use Auth\Provides\HookProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ModuleProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lito-auth');
		$this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'auth');
	}
	
	public function register()
	{
		$this->mergeConfigFrom(__DIR__.'/../../config/services.php', 'services');
		$this->app->register(MiddlewareProvider::class);
		$this->app->register(RouteProvider::class);
		$this->app->register(HookProvider::class);
	}
}