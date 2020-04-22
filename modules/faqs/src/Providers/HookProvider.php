<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:14 PM
 */

namespace Faqs\Providers;

use Faqs\Hook\FaqsHook;
use Faqs\Hook\HistoryFaqsHook;
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
        add_action('lito-register-menu', [FaqsHook::class, 'handle'], 70);
        add_action('lito_before_create_faqs', [HistoryFaqsHook::class, 'createHis'], 21);
        add_action('lito_before_edit_faqs', [HistoryFaqsHook::class, 'createHis'], 22);
        add_action('lito_before_delete_faqs', [HistoryFaqsHook::class, 'createHis'], 23);
    }
}