<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/4/2018
 * Time: 11:00 AM
 */

namespace Acl\Providers;

use Acl\Hook\AclHook;
use Acl\Hook\HistoryAclHook;
use Acl\Hook\QuickCreateRoleHook;
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
		add_action('lito-register-menu', [AclHook::class, 'handle'], 65);
        add_action('lito_before_create_new_role', [HistoryAclHook::class, 'createHis'], 35);
        add_action('lito_before_edit_role', [HistoryAclHook::class, 'createHis'], 36);
        add_action('lito_before_delete_role', [HistoryAclHook::class, 'createHis'], 37);
        add_action('lito-quick-create-menu', [QuickCreateRoleHook::class, 'handle'], 10);
	}
}