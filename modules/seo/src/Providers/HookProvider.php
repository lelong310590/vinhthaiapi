<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:26
 */

namespace Seo\Providers;

use Illuminate\Support\ServiceProvider;
use Seo\Hook\SeoHook;

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
        add_action('lito-register-menu', [SeoHook::class, 'handle'], 21);
    }
}