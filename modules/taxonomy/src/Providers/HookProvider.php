<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/5/2019
 * Time: 4:13 PM
 */
namespace Taxonomy\Providers;

use Illuminate\Support\ServiceProvider;
use Taxonomy\Hook\HistoryTaxonomyHook;
use Taxonomy\Hook\TaxonomyHook;

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
        add_action('lito-register-post-submenu', [TaxonomyHook::class, 'handle'], 20);
        add_action('lito_before_create_taxonomy', [HistoryTaxonomyHook::class, 'createHis'], 21);
        add_action('lito_before_edit_taxonomy', [HistoryTaxonomyHook::class, 'createHis'], 22);
        add_action('lito_before_delete_taxonomy', [HistoryTaxonomyHook::class, 'createHis'], 23);
    }
}