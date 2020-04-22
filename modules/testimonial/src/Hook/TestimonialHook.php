<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:08
 */

namespace Testimonial\Hook;

class TestimonialHook
{
    public function handle()
    {
        echo view('lito-testimonial::partials.sidebar');
    }
}