<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 3:53 PM
 */

namespace Setting\Hook;


class SettingHook
{
    public function handle()
    {
        echo view('lito-setting::partials.sidebar');
    }
}