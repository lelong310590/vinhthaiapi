<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:27
 */

namespace Seo\Hook;

class SeoHook
{
    public function handle()
    {
        echo view('lito-seo::partials.sidebar');
    }
}