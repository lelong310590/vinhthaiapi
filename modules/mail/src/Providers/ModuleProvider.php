<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:44 AM
 */

namespace Mail\Providers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Setting\Repositories\SettingRepositories;


class ModuleProvider extends ServiceProvider
{
    public function boot(SettingRepositories $settingRepositories)
    {

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'lito-mail');

        $setting = $settingRepositories->getAllSetting();
        Config::set('mail.driver',isset($setting['email_system_driver'])? $setting['email_system_driver'] : 'smtp');
        Config::set('mail.host',isset($setting['email_system_host'])? $setting['email_system_host'] : '');
        Config::set('mail.port',isset($setting['email_system_post'])? $setting['email_system_post'] : '');
        Config::set('mail.username',isset($setting['email_system_user'])? $setting['email_system_user'] : '');
        Config::set('mail.password',isset($setting['email_system_pass'])? $setting['email_system_pass'] : '');
        Config::set('mail.encryption',isset($setting['email_system_encrypt'])? $setting['email_system_encrypt'] : '');

    }

    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
        $this->app->register(InstallModuleProvider::class);
    }
}