<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:07
 */

namespace Testimonial\Providers;

use Illuminate\Support\ServiceProvider;
use Testimonial\Hook\HistoryTestimonialHook;
use Testimonial\Hook\TestimonialHook;

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
        add_action('lito-register-menu', [TestimonialHook::class, 'handle'], 85);
        add_action('lito_before_create_testimonial', [HistoryTestimonialHook::class, 'createHis'], 35);
        add_action('lito_before_edit_testimonial', [HistoryTestimonialHook::class, 'createHis'], 36);
        add_action('lito_before_delete_testimonial', [HistoryTestimonialHook::class, 'createHis'], 37);
    }
}