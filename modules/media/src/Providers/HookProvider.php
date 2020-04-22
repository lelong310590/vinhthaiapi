<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 11:21
 */

namespace Media\Providers;

use Illuminate\Support\ServiceProvider;
use Media\Hook\MediaHook;

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
        add_action('lito-register-menu', [MediaHook::class, 'handle'], 10);
    }
}