<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:46 AM
 */

namespace Mail\Providers;

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

    public function booted()
    {
        // add_action('nqadmin-register-menu', [MailHook::class, 'handle'], 45);
    }
}