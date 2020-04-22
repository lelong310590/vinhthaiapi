<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 3:56 PM
 */
namespace Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Setting\Hook\HistorySettingHook;
use Setting\Hook\SettingHook;

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
        add_action('lito-register-menu', [SettingHook::class, 'handle'], 100);
        add_action('lito_before_edit_setting', [HistorySettingHook::class, 'createHis'], 22);
    }
}