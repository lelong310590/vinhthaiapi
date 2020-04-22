<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/03/2019
 * Time: 02:09
 */

namespace Base\Providers;

use Base\Hook\HeaderNavHook;
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
        add_action('lito-register-header-nav', [HeaderNavHook::class, 'handle'], 5);
    }
}
