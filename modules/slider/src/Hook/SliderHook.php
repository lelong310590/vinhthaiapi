<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:37 PM
 */

namespace Slider\Hook;


class SliderHook
{
    public function handle()
    {
        echo view('lito-slider::partials.sidebar');
    }
}