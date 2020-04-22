<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:46 AM
 */

namespace Menu\Hook;

class MenuHook
{
    public function handle()
    {
        echo view('lito-menu::partials.sidebar');
    }
}