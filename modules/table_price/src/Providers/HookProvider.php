<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 14:58
 */

namespace TablePrice\Providers;

use Illuminate\Support\ServiceProvider;
use TablePrice\Hook\HistoryPriceHook;
use TablePrice\Hook\TablePriceHook;

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
       // add_action('lito-register-menu', [TablePriceHook::class, 'handle'], 80);
       // add_action('lito_before_create_table_price', [HistoryPriceHook::class, 'createHis'], 35);
        //add_action('lito_before_edit_table_price', [HistoryPriceHook::class, 'createHis'], 36);
       // add_action('lito_before_delete_table_price', [HistoryPriceHook::class, 'createHis'], 37);
    }
}