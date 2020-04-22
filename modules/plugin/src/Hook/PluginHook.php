<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:20
 */

namespace Plugin\Hook;

class PluginHook
{
    public function handle()
    {
        echo view('lito-plugin::partials.sidebar');
    }
}