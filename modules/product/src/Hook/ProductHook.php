<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 9:51 PM
 */

namespace Product\Hook;


class ProductHook
{
    public function handle()
    {
        echo view('lito-product::partials.sidebar');
    }
}