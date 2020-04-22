<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/26/2019
 * Time: 3:26 PM
 */

namespace Auth\Provides;

use Auth\Hook\HistoryAuthHook;
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
        add_action('lito_before_user_logged_in', [HistoryAuthHook::class, 'createHis'], 35);
        add_action('lito_before_user_logged_out', [HistoryAuthHook::class, 'createHis'], 36);
    }
}