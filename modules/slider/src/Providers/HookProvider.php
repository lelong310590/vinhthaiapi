<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:45 PM
 */

namespace Slider\Providers;

use Illuminate\Support\ServiceProvider;
use Slider\Hook\HistorySlideHook;
use Slider\Hook\SliderHook;

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
        add_action('lito-register-menu', [SliderHook::class, 'handle'], 75);
        add_action('lito_before_create_slider', [HistorySlideHook::class, 'createHis'], 21);
        add_action('lito_before_edit_slider', [HistorySlideHook::class, 'createHis'], 22);
        add_action('lito_before_delete_slider', [HistorySlideHook::class, 'createHis'], 23);
    }
}