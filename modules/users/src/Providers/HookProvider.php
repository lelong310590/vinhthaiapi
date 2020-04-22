<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 10:27 PM
 */

namespace Users\Providers;

use Illuminate\Support\ServiceProvider;
use Users\Hook\HistoryUserHook;
use Users\Hook\QuickCreateUserHook;
use Users\Hook\TestHook;
use Users\Hook\UsersHook;
use Users\Hook\UsersWidgetHook;

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
		add_action('lito-register-menu', [UsersHook::class, 'handle'], 60);
		add_action('lito-register-dashboard-widget', [UsersWidgetHook::class, 'handle'], 5);
        add_action('lito_before_create_new_user', [HistoryUserHook::class, 'createHis'], 35);
        add_action('lito_before_edit_user', [HistoryUserHook::class, 'createHis'], 36);
        add_action('lito_before_delete_new_user', [HistoryUserHook::class, 'createHis'], 37);
        add_action('lito-quick-create-menu', [QuickCreateUserHook::class, 'handle'], 5);
	}
}