<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/03/2019
 * Time: 02:09
 */

namespace Base\Hook;

class HeaderNavHook
{
    public function handle()
    {
        echo view('lito-dashboard::partials.header-nav');
    }
}